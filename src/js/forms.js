function resizeArea(textarea) {
    textarea.style.height = 58 + 'px';
    textarea.style.height = textarea.scrollHeight + 'px';
}

function resetAllSelects() {
    var selects = document.querySelectorAll('select');
    selects.forEach(function (select) {
        select.selectedIndex = 0;
    });
}

document.addEventListener("DOMContentLoaded", function () {
    const textareas = document.querySelectorAll("textarea[oninput]");
    textareas.forEach(textarea => resizeArea(textarea));
});