$(document).ready(function(){
    //  Affiche value dans l'input
    $('#ajouterclient').attr('class', 'btn btn-info');
    $('#modifierclient').addClass('disabled');
    $(".btnEditClient").click((e) =>{
        let text = displayData(e);

        let codecli = $("input[name*='codecli']");
        let nomcli = $("input[name*='nomcli']");

        codecli.val(text[0]);
        nomcli.val(text[1]);

        $('#modifierclient').attr('class', 'btn btn-info');
        $('#ajouterclient').attr('class', 'btn btn-default disabled');
    });

    $('#modifierclient').on('click', ()=>{
        $('#ajouterclient').attr('class', 'btn btn-info disabled');
    });

    function displayData(e){
        let id = 0;
        const td = $("tbody tr td");
        let text = [];
        for(const value of td){
            //Retrieve data-id and the icon clicked or target using dataset
            if(value.dataset.id == e.target.dataset.id){
                //console.log(value);
                text[id++] = value.textContent; 
            }
        }
        return text; 
        
    }
});