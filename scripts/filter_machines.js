
document.addEventListener("DOMContentLoaded", function () {

    document.getElementById("gruppoMuscolare").addEventListener("submit", function (event) {
        event.preventDefault();
        
        var selectedGroup = document.getElementById('gruppoMuscolareSelect').value;

        if (selectedGroup != '')
            filter(selectedGroup);

        return false;
    });
});

function filter(selectedGroup){
    var listaMacchinari = document.getElementById("cards-container");

    if (listaMacchinari) {
        var elementiLista = listaMacchinari.getElementsByTagName("li");

        for (var i = 0; i < elementiLista.length; i++) {
            var elemento = elementiLista[i];
            
            if (!elemento.classList.contains(selectedGroup) && selectedGroup != "Tutti") {
                elemento.classList.add("removed-element");
            } else {
                if (elemento.classList.contains("removed-element"))
                    elemento.classList.remove("removed-element");
            }
        }
    }
}