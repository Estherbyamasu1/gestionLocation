<!DOCTYPE html>
<html lang="en">

<head>
    <?php include VIEWPATH . 'includes/header.php'; ?>


    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
    </head>


</head>

<body>
    <?php include VIEWPATH . 'includes/loadpage.php'; ?>
    <div id="main-wrapper">
        <?php
        include VIEWPATH . 'includes/navybar.php'; ?>
    </div>
    <?php include VIEWPATH . 'includes/menu.php'; 
    ?>
    </div>

    <!-- debu -->
    <div class="container-fluid">
        <div class="container article">

            <!-- <article class="container article"> -->
                    <div class="card profile-card">
                    </div>

            <div class="home">
                <div class="card profile-card">
                    <button class="card-menu-btn icon-box" aria-label="More" data-menu-btn>
                        <span class="material-symbols-rounded icon">more_horiz</span>
                    </button>

                    <ul class="ctx-menu ">
                        <li class="ctx-item">
                            <button class="ctx-menu-btn icon-box">
                                <span class="material-symbols-rounded icon" aria-hidden="true">edit_note</span>
                                <span class="ctx-menu-text">Edit</span>
                            </button>
                        </li>

                        <li class="ctx-item">
                            <button class="ctx-menu-btn icon-box">
                                <span class="material-symbols-rounded icon" aria-hidden="true">cached</span>
                                <span class="ctx-menu-text">Refresh</span>
                            </button>
                        </li>

                        <li class="divider"></li>

                        <li class="ctx-item">
                            <button class="ctx-menu-btn icon-box red">
                                <span class="material-symbols-rounded icon" aria-hidden="true">delete</span>
                                <span class="ctx-menu-text">Deactivate</span>
                            </button>
                        </li>

                    </ul>

                    <div class="profile-card-wrapper">
                        <figure class="card-avatar">
                            <img src="https://i.postimg.cc/sxWYtVkn/avatar-1.jpg" 
                            alt="Elizabeth Foster" width="48" height="48">
                        </figure>

                        <div>
                            <p class="card-title">Admin </p>
                            <p class="card-subtitle">Web & Graphic Design</p>
                        </div>
                    </div>

                    <ul class="contact-list">
                        <li>
                            <a href="mailto:xyz@mail.com" class="contact-link icon-box">
                                <span class="material-symbols-rounded icon">mail</span>
                                <p class="text">admin@mail.com</p>
                            </a>
                        </li>

                        <li>
                            <a href="tel:+00123456789" class="contact-link icon-box">
                                <span class="material-symbols-rounded icon">call</span>
                                <p class="text">+257656789</p>
                            </a>
                        </li>
                    </ul>

                    <div class="divider card-divider"></div>

                    <ul class="progress-list">
                        <li class="progress-item">
                            <div class="project-label">
                                <h4 class="progress-title">Meuble Disponible</h4>
                                <data value="85" class="progress-data"><?=$totalmeubledisponible?></data>
                            </div>

                            <div class="progress-bar">
                                <div class="progress" style="--width: 85%; --bg: var(--blue-ryb);"></div>
                            </div>
                        </li>

                        <li class="progress-item">
                            <div class="project-label">
                                <p class="progress-title">Meuble réservé</p>
                                <data value="7.5" class="progress-data"><?=$totalmeubleReservation?></data>
                            </div>

                            <div class="progress-bar">
                                <div class="progress" style="--width: 75%; --bg: var(--coral);"></div>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="card-wrapper">
                    <div class="card task-card">
                        <div class="card-icon icon-box black">
                            <h4 class="material-symbols-rounded icon"><?=$Totalmeuble?></h4>
                        </div>

                        <div>
                          
                            <p class="card-text text-black">Meuble </p>
                        </div>
                    </div>

               

                    <div class="card task-card">
                        <div class="card-icon icon-box black">
                            <h4 class="material-symbols-rounded icon"><?=$nbrreservation?></h4>
                        </div>

                        <div>
                          
                            <p class="card-text text-black">Nombre de reservations </p>
                        </div>
                    </div>
                </div>

                <div class="card revenue-card">
                    <button class="card-menu-btn icon-box" aria-label="More" data-menu-btn>
                        <span class="material-symbols-rounded icon">more_horiz</span>
                    </button>

                    <ul class="ctx-menu ">
                        <li class="ctx-item">
                            <button class="ctx-menu-btn icon-box">
                                <span class="material-symbols-rounded icon" aria-hidden="true">edit</span>
                                <span class="ctx-menu-text">Edit</span>
                            </button>
                        </li>

                        <li class="ctx-item">
                            <button class="ctx-menu-btn icon-box">
                                <span class="material-symbols-rounded icon" aria-hidden="true">cached</span>
                                <span class="ctx-menu-text">Refresh</span>
                            </button>
                        </li>

                    </ul>

                    <p class="card-title">Revenue</p>
                    <data value="2100" class="card-price">BIF <?=$Totalpaiement?></data>
                    <p class="card-text">Total revenue</p>
                    <div class="divider card-divider">

                    </div>

                    <ul class="revenue-list">
                       
                    <p class="card-title">Locataire</p>
                    <data value="2100" class="card-price"> <?=$TotalLocataire?></data>
                    <p class="card-text">Total Locataire</p>
                    <div class="divider card-divider">
                        
                    </div>

                      
                    </ul>
                </div>
            </div>

            <!-- <div class="tasks">
                <div class="section-title-wrapper">
                    <h2 class="section-title">Recent Projects</h2>

                    <button class="btn btn-link icon-box">
                        <span>View All</span>
                        <span class="material-symbols-rounded icon" aria-hidden="true">arrow_forward</span>
                    </button>
                </div>

                <ul class="tasks-list">
                    <li class="tasks-item">
                        <div class="card task-card">
                            <div class="card-input">
                                <input type="checkbox" name="task-1" id="task-1">
                                <label for="task-1" class="task-label">Draft the new contract document for sales team</label>
                            </div>

                            <div class="card-badge cyan radius-pill">Today 10pm</div>

                            <ul class="card-meta-list">
                                <li>
                                    <div class="meta-box icon-box">
                                        <span class="material-symbols-rounded icon">list</span>
                                        <span>3/7</span>
                                    </div>
                                </li>

                                <li>
                                    <div class="meta-box icon-box">
                                        <span class="material-symbols-rounded icon">comment</span>
                                        <data value="21">21</data>
                                    </div>
                                </li>

                                <li>
                                    <div class="card-badge red">High</div>
                                </li>
                            </ul>
                        </div>

                    </li>

                    <li class="tasks-item">
                        <div class="card task-card">
                            <div class="card-input">
                                <input type="checkbox" name="task-2" id="task-2">
                                <label for="task-2" class="task-label">iOS App Home Page Design</label>
                            </div>

                            <div class="card-badge cyan radius-pill">Today 5pm</div>

                            <ul class="card-meta-list">
                                <li>
                                    <div class="meta-box icon-box">
                                        <span class="material-symbols-rounded icon">list</span>
                                        <span>10/11</span>
                                    </div>
                                </li>

                                <li>
                                    <div class="meta-box icon-box">
                                        <span class="material-symbols-rounded icon">comment</span>
                                        <data value="5">5</data>
                                    </div>
                                </li>

                                <li>
                                    <div class="card-badge orange">Medium</div>
                                </li>
                            </ul>
                        </div>

                    </li>

                    <li class="tasks-item">
                        <div class="card task-card">
                            <div class="card-input">
                                <input type="checkbox" name="task-3" id="task-3">
                                <label for="task-3" class="task-label">Enable Analytics Tracking</label>
                            </div>

                            <div class="card-badge radius-pill">Tomorrow 5pm</div>

                            <ul class="card-meta-list">
                                <li>
                                    <div class="meta-box icon-box">
                                        <span class="material-symbols-rounded icon">list</span>
                                        <span>5/11</span>
                                    </div>
                                </li>

                                <li>
                                    <div class="meta-box icon-box">
                                        <span class="material-symbols-rounded icon">comment</span>
                                        <data value="7">7</data>
                                    </div>
                                </li>

                                <li>
                                    <div class="card-badge orange">Medium</div>
                                </li>
                            </ul>
                        </div>

                    </li>

                    <li class="tasks-item">
                        <div class="card task-card">
                            <div class="card-input">
                                <input type="checkbox" name="task-4" id="task-4">
                                <label for="task-4" class="task-label">Kanban Board Design</label>
                            </div>

                            <div class="card-badge radius-pill">Sep 11, 3pm</div>

                            <ul class="card-meta-list">
                                <li>
                                    <div class="meta-box icon-box">
                                        <span class="material-symbols-rounded icon">list</span>
                                        <span>0/5</span>
                                    </div>
                                </li>

                                <li>
                                    <div class="meta-box icon-box">
                                        <span class="material-symbols-rounded icon">comment</span>
                                        <data value="3">3</data>
                                    </div>
                                </li>

                                <li>
                                    <div class="card-badge green">Low</div>
                                </li>
                            </ul>
                        </div>

                    </li>
                </ul>

                <button class="btn btn-primary" data-load-more>
                    <span class="spiner"></span>
                    <span>Load More</span>
                </button>
            </div> -->
            <!-- </article> -->

            <!-- fin -->
        </div>
    </div>
    <?= include VIEWPATH . 'includes/scripts_js.php'; ?>

</body>

<?= include VIEWPATH . 'includes/legende.php' ?>

</html>

<script type="text/javascript">
    $('#message').delay('slow').fadeOut(3000);

    document.addEventListener('DOMContentLoaded', function() {
        // Données pour le graphique linéaire (Line Chart)
        const lineChartCtx = document.getElementById('lineChart').getContext('2d');
        new Chart(lineChartCtx, {
            type: 'line',
            data: {
                labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
                datasets: [{
                    label: 'Visites Uniques',
                    data: [65, 59, 80, 81, 56, 55, 40],
                    borderColor: '#007bff',
                    backgroundColor: 'rgba(0, 123, 255, 0.1)',
                    fill: true,
                    tension: 0.3 // Rend la ligne plus douce
                }, {
                    label: 'Visites Répétées',
                    data: [30, 40, 45, 50, 60, 70, 75],
                    borderColor: '#28a745',
                    backgroundColor: 'rgba(40, 167, 69, 0.1)',
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // Permet de mieux contrôler la taille du graphique
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Nombre de visites'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Jours de la semaine'
                        }
                    }
                },
                plugins: {
                    title: {
                        display: false, // Le titre est déjà dans le HTML
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    }
                }
            }
        });

        // Données pour le graphique à barres (Bar Chart)
        const barChartCtx = document.getElementById('barChart').getContext('2d');
        new Chart(barChartCtx, {
            type: 'bar',
            data: {
                labels: ['Électronique', 'Vêtements', 'Alimentaire', 'Maison', 'Livres'],
                datasets: [{
                    label: 'Nombre de Ventes',
                    data: [120, 190, 30, 50, 200],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Unités Vendues'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Catégories de Produits'
                        }
                    }
                },
                plugins: {
                    title: {
                        display: false,
                    },
                    legend: {
                        display: false // Cache la légende pour un graphique à barres simple
                    }
                }
            }
        });
    });
</script>



<script src="https://checkout.flutterwave.com/v3.js"></script>

<script>
    document.getElementById("formPaiement").addEventListener("submit", function(e) {
        e.preventDefault();

        const mode = document.getElementById("mode_paiement").value;
        const montant = document.getElementById("montant").value;

        if (mode === "flutterwave") {
            FlutterwaveCheckout({
                public_key: "FLWPUBK_TEST-XXXXXXXXX",
                tx_ref: "TX_" + Date.now(),
                amount: montant,
                currency: "BIF",
                payment_options: "card,mobilemoneyuganda,mobilemoneyrwanda,ussd",
                customer: {
                    email: "<?php echo $this->session->userdata('LOCATAIRE_EMAIL'); ?>",
                    phone_number: "<?php echo $this->session->userdata('LOCATAIRE_PHONE'); ?>",
                    name: "<?php echo $this->session->userdata('LOCATAIRE_NAME'); ?>",
                },
                callback: function(data) {
                    // Rediriger pour traitement backend
                    window.location.href = "<?php echo base_url('perso/confirmation_flutterwave'); ?>?ref=" + data.transaction_id;
                },
                onclose: function() {
                    alert('Paiement annulé');
                },
                customizations: {
                    title: "Paiement Location",
                    description: "Paiement réservation logement",
                    logo: "<?php echo base_url('assets/logo.png'); ?>"
                }
            });
        } else {
            // Paiement local Mvola ou Airtel
            fetch("<?php echo base_url('perso/paiement_local'); ?>", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        montant: montant,
                        mode_paiement: mode
                    })
                })
                .then(res => res.json())
                .then(data => {
                    alert(data.message);
                })
                .catch(err => {
                    console.error("Erreur:", err);
                    alert("Erreur lors du paiement local.");
                });
        }
    });
</script>

<style>
    :root {
        --imperial-red_12: hsla(357, 86%, 57%, 0.12);
        --pacific-blue_12: hsla(188, 78%, 41%, 0.12);
        --davys-gray_12: hsla(210, 9%, 31%, 0.12);
        --imperial-red: hsl(357, 86%, 57%);
        --sonic-sliver: hsl(0, 0%, 47%);
        --pacific-blue: hsl(188, 78%, 41%);
        --blue-ryb_12: hsla(220, 100%, 50%, 0.12);
        --space-cadet: hsl(220, 41%, 20%);
        --eerie-black: hsl(214, 10%, 13%);
        --davys-gray: hsl(210, 9%, 31%);
        --emerald_12: hsla(144, 62%, 53%, 0.12);
        --cool-gray: hsl(225, 11%, 59%);
        --cultured: hsl(225, 20%, 96%);
        --blue-ryb: hsl(220, 100%, 50%);
        --black_08: hsla(0, 0%, 0%, 0.06);
        --black_12: hsla(0, 0%, 0%, 0.12);
        --coral_12: hsla(15, 100%, 65%, 0.12);
        --sunglow: hsl(44, 100%, 61%);
        --emerald: hsl(144, 62%, 53%);
        --onyx-2: hsl(210, 10%, 23%);
        --coral: hsl(15, 100%, 65%);
        --white: hsl(0, 0%, 100%);
        --onyx: hsl(207, 8%, 21%);

        --ff-vietnam: "Be Vietnam Pro", sans-serif;

        --fs-1: 1.563rem;
        --fs-2: 1.5rem;
        --fs-3: 1.25rem;
        --fs-4: 1.078rem;
        --fs-5: 1rem;
        --fs-6: 0.938rem;
        --fs-7: 0.875rem;
        --fs-8: 0.844rem;
        --fs-9: 0.813rem;
        --fs-10: 0.769rem;

        --fw-500: 500;
        --fw-600: 600;

        --transition: 0.25s ease;
        --cubic-out: cubic-bezier(0.45, 0.85, 0.5, 1);
        --cubic-in: cubic-bezier(0.5, 0, 0.50, 0.95);

        --radius-6: 6px;

        --shadow-1: 0 12px 20px hsla(210, 10%, 23%, 0.07);
        --shadow-2: 0 2px 10px hsla(0, 0%, 0%, 0.04);
        --shadow-3: 0 2px 20px var(--black_08);

    }

    *,
    *::before,
    *::after {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    li {
        list-style: none;
    }

    a,
    img,
    span,
    data,
    time,
    input,
    button,
    span.icon {
        display: block;
    }

    a {
        text-decoration: none;
    }

    button {
        font: inherit;
        background: none;
        border: none;
        cursor: pointer;
        text-align: left;
    }

    html {
        font-family: var(--ff-vietnam);
        scroll-behavior: smooth;
    }

    body {
        padding-block-start: 72px;
        background: var(--cultured);
    }

    :focus-visible {
        outline: 2px solid var(--onyx);
        outline-offset: 1px;
    }

    ::-webkit-scrollbar {
        width: 10px;
    }

    ::-webkit-scrollbar-thumb {
        background: hsl(0, 0%, 80%);
    }

    ::-webkit-scrollbar-thumb:hover {
        background: hsl(0, 0%, 70%);
    }

    ::-webkit-scrollbar-track {
        background: hsl(0, 0%, 95%);
    }

    .container {
        padding-inline: 15px;
    }

    .icon-box {
        font-variation-settings: 'wght' 300;
    }

    .icon-box .icon {
        font-size: 22px;
    }

    .h2,
    .h3 {
        color: var(--onyx);
        font-weight: var(--fw-600);
    }

    .h2 {
        font-size: var(--fs-3);
    }

    .card {
        background: var(--white);
        position: relative;
        padding: 24px;
        border-radius: var(--radius-6);
        box-shadow: var(--shadow-2);
    }

    .card-menu-btn {
        position: absolute;
        top: 16px;
        right: 16px;
        color: var(--cool-gray);
        padding: 6px;
        border-radius: var(--radius-6);
    }

    .card-menu-btn:is(:hover, :focus) {
        background: var(--black_08);
    }

    .ctx-menu {
        background: var(--white);
        position: absolute;
        top: 55px;
        right: 16px;
        padding: 10px 5px;
        box-shadow: var(--shadow-1);
        border-radius: var(--radius-6);
        display: none;
    }

    .ctx-menu.active {
        display: block;
    }

    .ctx-menu-btn {
        color: var(--color, var(--sonic-sliver));
        font-size: var(--fs-6);
        display: flex;
        justify-content: flex-start;
        align-items: center;
        width: 100%;
        gap: 8px;
        padding: 5px 25px;
        border-radius: var(--radius-6);
    }

    .ctx-menu-btn:is(:hover, :focus) {
        color: var(--hover-color), var(--eerie-black);
        background: var(--black_08);
    }

    .ctx-menu-btn.red {
        --hover-color: var(--imperial-red);
        --color: var(--imperial-red);
    }

    .divider {
        height: 1px;
        background: var(--bg, var(--black_08));
        margin-block: var(--mb, 8px);
    }

    .card-divider {
        --bg: var(--black_12);
        --mb: 25px;
    }

    .section-title-wrapper {
        padding-block: 25px;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        gap: 5px;
    }

    .section-title {
        color: var(--onyx);
        font-size: var(--fs-5);
        font-weight: var(--fw-600);
    }

    .btn {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: var(--fs-9);
        font-weight: var(--fw-600);
        padding: 8px 16px;
        border-radius: var(--radius-6);
    }

    .btn .icon {
        font-size: 16px;
        font-variation-settings: 'wght' 400;
    }

    .btn-link {
        color: var(--blue-ryb);
    }

    .btn-link:is(:hover, :focus) {
        background: var(--blue-ryb_12);
    }

    .btn-primary {
        color: var(--blue-ryb);
        border: 1px solid var(--blue-ryb);
        transition: var(--transition);
    }

    .btn-primary:is(:hover, :focus) {
        background: var(--blue-ryb);
        color: var(--white);
        box-shadow: 0 10px 10px -8px var(--blue-ryb);
    }

    .card-badge {
        background: var(--bg, var(--davys-gray_12));
        color: var(--color, var(--davys-gray));
        font-size: var(--fs-10);
        font-weight: var(--fw-600);
        width: max-content;
        padding: 3px 8px;
        border-radius: var(--radius-6);
    }

    .card-badge.blue {
        --bg: var(var(--blue-ryb_12));
        --color: var(--blue-ryb);
    }

    .card-badge.orange {
        --bg: var(var(--coral_12));
        --color: var(--coral);
    }

    .card-badge.cyan {
        --bg: var(var(--pacific-blue_12));
        --color: var(--pacific-blue);
    }

    .card-badge.red {
        --bg: var(var(--imperial-red_12));
        --color: var(--imperial-red);
    }

    .card-badge.green {
        --bg: var(var(--emerald_12));
        --color: var(--emerald);
    }

    .card-badge.radius-pill {
        border-radius: 50px;
    }

    /*Header*/

    .header {
        background: var(--white);
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 72px;
        padding-block: 20px;
        overflow: hidden;
        transition: .3s var(--cubic-in);
        box-shadow: var(--shadow-3);
        z-index: 1;
    }

    .header.active {
        height: 370px;
        transition: .5s var(--cubic-out);
    }

    .header>.container {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo {
        font-size: var(--fs-1);
        font-weight: var(--fw-600);
        color: var(--space-cadet);
    }

    .menu-toggle-btn .icon {
        font-size: 28px;
    }

    .navbar {
        position: absolute;
        top: 72px;
        left: 0;
        width: 100%;
        background: var(--white);
        opacity: 0;
        visibility: hidden;
        transition: .5s var(--cubic-out);
    }

    .header.active .navbar {
        opacity: 1;
        visibility: visible;
    }

    .navbar-list {
        padding-inline: 15px;
        margin-bottom: 15px;
    }

    .navbar-link {
        color: var(--onyx);
        font-size: var(--fs-6);
        font-weight: var(--fw-500);
        display: flex;
        align-items: center;
        gap: 5px;
        padding: 10px;
        border-radius: var(--radius-6);
    }

    :is(.navbar-link, .notification, .header-profile):is(:hover, :focus) {
        background: var(--black_08);
    }

    .navbar-link.active {
        color: var(--blue-ryb);
    }

    .user-action-list {
        padding-inline: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-direction: row-reverse;
    }

    .notification {
        color: var(--onyx);
        padding: 8px;
        border-radius: var(--radius-6);
    }

    .header-profile {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px;
        padding-right: 15px;
        border-radius: var(--radius-6);
    }

    .profile-avatar {
        overflow: hidden;
        border-radius: var(--radius-6);
    }

    .header :is(.profile-title, .profile-subtitle) {
        font-size: var(--fs-9);
    }

    .header .profile-title {
        color: var(--onyx);
        margin-bottom: 2px;
        font-weight: var(--fw-600);
    }

    .header .profile-subtitle {
        color: var(--cool-gray);
        font-weight: var(--fw-500);
    }

    /*Main - Home*/

    .article.container {}

    .home {
        display: grid;
        gap: 25px;
    }

    .article-title {
        margin-bottom: 10px;
    }

    .article-subtitle {
        color: var(--davys-gray);
        font-size: var(--fs-6);
        font-weight: var(--fw-500);
        margin-bottom: 25px;
    }

    .profile-card-wrapper {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
        margin-bottom: 32px;
    }

    .card-avatar {
        overflow: hidden;
        border-radius: var(--radius-6);
    }

    .card-title {
        color: var(--onyx);
        font-weight: var(--fw-600);
        margin-bottom: 5px;
    }

    .card-subtitle {
        color: var(--cool-gray);
        font-size: var(--fs-7);
    }

    .contact-list {
        display: flex;
        flex-wrap: wrap;
        gap: 8px 16px;
    }

    .contact-link {
        color: var(--cool-gray);
        font-size: var(--fs-7);
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .progress-item:not(:last-child) {
        margin-bottom: 25px;
    }

    .progress-label {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .progress-title {
        color: var(--onyx-2);
        font-size: var(--fs-8);
        font-weight: var(--fw-500);
    }

    .progress-data {
        color: var(--davys-gray);
        font-size: var(--fs-6);
    }

    .progress-bar {
        margin-top: 15px;
        width: 100%;
        height: 6px;
        background: var(--cultured);
        border-radius: var(--radius-6);
        overflow: hidden;
    }

    .progress {
        width: var(--width, 100%);
        height: 100%;
        background: var(--bg, var(--onyx));
    }

    .home .card-wrapper {
        display: grid;
        gap: 25px;
    }

    .home .task-card {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .home .task-card .icon {
        font-size: 28px;
        color: var(--color);
    }

    .home .task-card .card-icon {
        background: var(--background);
        padding: 10px;
        border-radius: var(--radius-6);
    }

    .home .task-card .card-icon.green {
        --background: var(--emerald_12);
        --color: var(--emerald);
    }

    .home .task-card .card-icon.blue {
        --background: var(--pacific-blue_12);
        --color: var(--pacific-blue);
    }

    .home .task-card .card-data {
        color: var(--onyx-2);
        font-size: var(--fs-3);
        font-weight: var(--fw-600);
        margin-bottom: 5px;
    }

    .home .task-card .card-text {
        color: var(--cool-gray);
        font-size: var(--fs-6);
    }

    .revenue-card .card-title {
        margin-bottom: 15px;
    }

    .card-price {
        color: var(--onyx);
        font-size: var(--fs-2);
        font-weight: var(--fw-600);
        margin-bottom: 12px;
    }

    .revenue-card .card-text {
        color: var(--cool-gray);
        font-size: var(--fs-6);
    }

    .revenue-item {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .revenue-item:first-child {
        margin-bottom: 10px;
    }

    .revenue-item .icon {
        font-size: 30px;
    }

    .revenue-item .icon.green {
        color: var(--emerald);
    }

    .revenue-item .icon.red {
        color: var(--imperial-red);
    }

    .revenue-item-data {
        color: var(--onyx);
        font-size: var(--fs-6);
        font-weight: var(--fw-600);
        margin-bottom: 5px;
    }

    .revenue-item-text {
        color: var(--cool-gray);
        font-size: var(--fs-9);
    }

    /*Main - Projects*/

    .project-list {
        display: grid;
        gap: 25px;
    }

    .project-card .card-date {
        color: var(--cool-gray);
        font-size: var(--fs-9);
        font-weight: var(--fw-500);
        margin-bottom: 20px;
    }

    .project-card .card-title {
        color: var(--onyx);
        font-size: var(--fs-4);
        margin-bottom: 8px;
    }

    .project-card .card-title>a {
        color: inherit;
        transition: var(--transition);
    }

    .project-card .card-title>a:is(:hover, :focus) {
        color: var(--blue-ryb);
    }

    .project-card .card-badge {
        margin-bottom: 20px;
    }

    .project-card .card-text {
        color: var(--cool-gray);
        font-size: var(--fs-7);
        line-height: 1.7;
        margin-bottom: 15px;
    }

    .project-card .card-progress-box {
        margin-bottom: 15px;
    }

    .project-card .progress-title {
        font-weight: var(--fw-600);
    }

    .project-card .progress-data {
        color: var(--onyx);
        font-size: var(--fs-9);
        font-weight: var(--fw-600);
    }

    .project-card .progress-bar {
        margin-top: 10px;
    }

    .card-avatar-list {
        display: flex;
        justify-content: flex-start;
        align-items: center;
    }

    .card-avatar-item>a {
        border: 2px solid var(--white);
        border-radius: 50%;
        overflow: hidden;
    }

    .card-avatar-item:not(:first-child) {
        margin-left: -15px;
    }

    /*Main - Tasks*/

    .tasks-item:not(:last-child) {
        margin-bottom: 10px;
    }

    .tasks .task-card {
        display: grid;
        gap: 15px;
    }

    .tasks .card-input {
        display: flex;
        align-items: flex-start;
        gap: 8px;
    }

    .tasks .card-input>input {
        margin-top: 2px;
        accent-color: var(--blue-ryb);
    }

    .tasks .card-input>input:checked {
        filter: drop-shadow(0 0 2px var(--blue-ryb));
    }

    .tasks .task-label {
        color: var(--davys-gray);
        font-size: var(--fs-9);
        font-weight: var(--fw-600);
        line-height: 1.5;
    }

    .tasks .card-meta-list {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        gap: 15px;
    }

    .tasks .meta-box {
        color: var(--davys-gray);
        font-size: var(--fs-9);
        font-weight: var(--fw-600);
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .tasks .btn-primary {
        margin-block: 25px;
        margin-inline: auto;
    }

    .tasks .btn-primary .spiner {
        padding: 6px;
        border: 2px solid var(--blue-ryb);
        border-top-color: transparent;
        border-radius: 50%;
        animation: rotate .75s linear infinite;
        display: none;
    }

    .tasks .btn-primary.active .spiner {
        display: block;
    }

    .tasks .btn-primary:is(:hover, :focus) .spiner {
        border-color: var(--white);
        border-top-color: transparent;
    }

    @keyframes rotate {
        0% {
            transform: rotate(0);
        }

        100% {
            transform: rotate(1turn);
        }
    }

    /*Footer*/

    .footer {
        background: var(--white);
        padding-block: 25px;
    }

    .footer-list {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start;
        align-items: flex-start;
        margin-bottom: 10px;
    }

    .footer-link,
    .copyright {
        color: var(--davys-gray);
        font-size: var(--fs-6);
        line-height: 1.7;
    }

    .footer-link,
    .copyright-link {
        display: inline-block;
        transition: var(--transition);
    }

    :is(.footer-link, .copyright-link):is(:hover, :focus) {
        color: var(--blue-ryb);
    }

    .footer-item:not(:last-child)::after {
        content: "-";
        color: hsl(0, 0%, 80%);
        font-weight: var(--fw-600);
        margin-inline: 5px;
    }

    .copyright-link {
        color: inherit;
    }

    /*Media Queries*/

    @media(min-width: 400px) {
        .revenue-item:first-child {
            margin-bottom: 0;
        }

        .revenue-list {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }
    }

    @media(min-width: 570px) {
        .container {
            max-width: 550px;
            margin-inline: auto;
        }

        .navbar-list,
        .user-action-list {
            padding-inline: 0;
        }

        .card-price {
            --fs-2: 1.625rem;
        }

        .tasks .card-meta-list {
            justify-content: flex-end;
        }
    }

    @media(min-width: 768px) {
        .container {
            max-width: 700px;
        }

        .progress-list {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        .progress-item:not(:last-child) {
            margin-bottom: 0;
        }

        .home .card-wrapper {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media(min-width: 992px) {
        .container {
            max-width: 950px;
        }

        .menu-toggle-btn {
            display: none;
        }

        .header {
            height: unset;
            padding-block: 10px;
        }

        .header.active {
            height: unset;
        }

        .navbar {
            all: unset;
            flex-grow: 1;
        }

        .navbar .container {
            display: flex;
        }

        .navbar-list {
            margin-bottom: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-inline: auto;
        }

        .user-action-list {
            flex-direction: row;
            gap: 20px;
        }

        .article.container {}

        .home {
            grid-template-columns: 1.25fr .75fr 1fr;
        }

        .home .card-wrapper {
            grid-template-columns: 1fr;
        }

        .progress-list {
            align-items: flex-end;
        }

        .project-list {
            grid-template-columns: repeat(3, 1fr);
        }

        .tasks .task-card {
            grid-template-columns: 1fr .5fr .5fr;
            align-items: center;
        }

        .footer-list {
            margin-bottom: 0;
        }

        .footer .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    }

    @media(min-width: 1200px) {
        .container {
            max-width: 1150px;
        }

        .navbar-list {
            gap: 25px;
        }

        .card-price {
            --fs-2: 1.780rem;
        }
    }
</style>