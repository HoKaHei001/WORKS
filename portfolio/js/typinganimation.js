window.addEventListener('load', init);
function init() {
    var effectList = [];
    var elementList = document.querySelectorAll('.text-shuffle');
    var hoverTarget = document.getElementsByClassName("works_item_preview");
    for (let i = 0; i < elementList.length; i++) {
        var element = elementList[i];
        element.dataset.index = i;
        effectList[i] = new ShuffleText(element);
        hoverTarget[i].addEventListener('mouseenter', function () {
            effectList[i].start();
        });
    }
}
