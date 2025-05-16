<div id="myDiv"></div>


<script type="text/javascript">
$(function() {
    $('#myDiv').floatingWhatsApp({
        phone: '+25779128128',
        message: '',
        popupMessage: 'Bonjour. Comment puis-je vous assister?',
        position: 'right',
        headerTitle: '<img width="30px" src="<?=base_url()?>assets/img/Blason_du_Burundi.png" />  Assistant en ligne CGM',
        showPopup: true
    });
});
</script>