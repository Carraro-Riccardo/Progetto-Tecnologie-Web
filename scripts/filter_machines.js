
document.addEventListener("DOMContentLoaded", function () {

    document.getElementById("gruppoMuscolareSelect").addEventListener("change", function (event) {
        event.preventDefault();
        
        var selectedGroup = document.getElementById('gruppoMuscolareSelect').value;

        console.log(selectedGroup);

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
                elemento.classList.add("hidden_element");
            } else {
                if (!elemento.classList.contains("hidden_element"))
                    elemento.classList.remove("hidden_element");
            }
        }
    }
}