$(document).ready(function(){
    $('#ajoutercarburant').attr('class', 'btn btn-info');
    $('#modifiercarburant').addClass('disabled');
    $(".btneditcarburant").click((e) =>{
        let text = displayData(e);
    
        let numCrb = $("input[name*='numCrb']");
        let designCrb = $("input[name*='designCrb']");
        let puCrb = $("input[name*='puCrb']");
        let stockCrb = $("input[name*='stockCrb']");

        numCrb.val(text[0]);
        designCrb.val(text[1]);
        puCrb.val(text[2]);
        stockCrb.val(text[3]);

        $('#modifiercarburant').attr('class', 'btn btn-info');
        $('#ajoutercarburant').attr('class', 'btn btn-default disabled');
    });
    
    $('#modifiercarburant').on('click', ()=>{
        $('#ajoutercarburant').attr('class', 'btn btn-info disabled');
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
})