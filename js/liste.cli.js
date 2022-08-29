$(document).ready(function(){
    $('#entre2date').hide();
    $('#annee').hide();
    $('#mois').hide();

    $('#choix').on('change', ()=>{

        if($('#choix').val() === 'entre2date'){

            $('#entre2date').show();
            $('#tab2Annee').show();
            $('#annee').hide();
            $('#mois').hide();

        } else if($('#choix').val() === 'recherche'){

           $('#entre2date').hide();
            $('#annee').hide();
            $('#mois').hide();

        } else if($('#choix').val() === 'parannee'){
            $('#entre2date').hide();
            $('#annee').show();
            $('#tabAnnee').show();
            $('#mois').hide();

        } else if($('#choix').val() === 'parmois'){
            $('#entre2date').hide();
            $('#annee').hide();
            $('#mois').show();
            $('#tabMois').show();
        }
    });
    
    $('#lienAnne').on('click', ()=>{
        $('#tabAnnee').show();
        $('#tabMois').hide();
        $('#tab2Annee').hide();
        var ans = $('#ans').val();
        $('#lienAnne').attr('href', 'http://localhost/projet/gvc/liste.client.php?id='+ans);
    });

    $('#lienMois').on('click', ()=>{
        $('#tabMois').show();
        $('#tabAnnee').hide();
        $('#tab2Annee').hide();
        var ans = $('#ansM').val();
        $('#lienMois').attr('href', 'http://localhost/projet/gvc/liste.client.php?idM='+ans);
    });

    $('#lien2D').on('click', ()=>{
        $('#tab2Annee').show();
        $('#tabMois').hide();
        $('#tabAnnee').hide();
        var date1 = $('#date1').val();
        var date2 = $('#date2').val();
        $('#lien2D').attr('href', 'http://localhost/projet/gvc/liste.client.php?idD1='+date1+'&idD2='+date2);
    });

});