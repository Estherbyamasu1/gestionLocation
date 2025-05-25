<?php
//22/05/2025
//pour recuperer tout les quartiers des goma et leurs avenue
class Quartier_Avenue extends CI_Controller  
{
	function __construct()
	{  
		parent::__construct(); 
		$this->is_auth();
		$this->load->model('Model');

       
	}

	public function is_auth()
	{
		if (empty($this->session->userdata('USER_ID'))) {
			redirect(base_url('Login'));
		}
	}

	public function import_osm_goma()
	{
       

		$queryQuartiers = '
		[out:json][timeout:25];
		area["name"="Goma"]->.searchArea;
		relation["boundary"="administrative"]["admin_level"~"8|9"](area.searchArea);
		out center;
		';



		$quartiers = $this->fetch_osm_data($queryQuartiers);

        // print_r($quartiers);die();

        $quartiersIdsMap = []; // Pour garder en mémoire ID OSM et ID local

        foreach ($quartiers as $quartier) {
        	if (!isset($quartier['tags']['name'])) continue;
        	$nomQuartier = $quartier['tags']['name'];
        	$lat = $quartier['center']['lat'] ?? null;
        	$lon = $quartier['center']['lon'] ?? null;

        	$data = [
        		'DESC_QUARTIER' => $nomQuartier,
        		'LATITUDE' => $lat,
        		'LONGITUDE' => $lon,
        	];

        	$idLocal = $this->Model->insert_quartier_return_id($data);

        	$quartiersIdsMap[$quartier['id']] = $idLocal;
        }

        // Étape 2 : Import avenues (way highway=primary|secondary|tertiary)
        $queryAvenues = '
        [out:json][timeout:25];
        area["name"="Goma"]->.searchArea;
        way["highway"~"primary|secondary|tertiary"](area.searchArea);
        out tags center;
        ';

        $avenues = $this->fetch_osm_data($queryAvenues);

        foreach ($avenues as $avenue) {
        	if (!isset($avenue['tags']['name'])) continue;
        	$nomAvenue = $avenue['tags']['name'];
        	$lat = $avenue['center']['lat'] ?? ($avenue['lat'] ?? null);
        	$lon = $avenue['center']['lon'] ?? ($avenue['lon'] ?? null);

            // $idQuartierLocal = null; // Pas d'association dans cet exemple
$idQuartierLocal = $this->find_closest_quartier($lat, $lon, $quartiersIdsMap, $quartiers);
            $data = [
            	'DESC_AVENUE' => $nomAvenue,
            	'LATITUDE' => $lat,
            	'LONGITUDE' => $lon,
            	'ID_QUARTIER' => $idQuartierLocal,
            ];

            // Insérer avenue via modèle Avenue_model
           
            $this->Model->insert_avenue($data);
        }

        echo "Import quartiers et avenues terminé.";
    }

    // Fonction auxiliaire pour requête Overpass API
    private function fetch_osm_data(string $query): array
    {
    	$url = 'https://overpass-api.de/api/interpreter';

    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL, $url);
    	curl_setopt($ch, CURLOPT_POST, 1);
    	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(['data' => $query]));
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    	$response = curl_exec($ch);
    	curl_close($ch);

    	$data = json_decode($response, true);
    	return $data['elements'] ?? [];
    }


    private function find_closest_quartier($lat, $lon, $quartiersIdsMap, $quartiers)
{
    $minDistance = PHP_INT_MAX;
    $closestId = null;

    foreach ($quartiers as $quartier) {
        $qid = $quartier['id'];
        if (!isset($quartier['center'])) continue;

        $qlat = $quartier['center']['lat'];
        $qlon = $quartier['center']['lon'];

        // Calcul de la distance
        $distance = sqrt(pow($lat - $qlat, 2) + pow($lon - $qlon, 2));

        if ($distance < $minDistance) {
            $minDistance = $distance;
            $closestId = $quartiersIdsMap[$qid] ?? null;
        }
    }

    return $closestId;
}
}
?>