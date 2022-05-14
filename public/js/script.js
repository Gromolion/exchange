
document.querySelector('.selector').addEventListener('mouseenter', event => {
    document.querySelector('.dropmenu').classList.toggle('hide');
    event.stopPropagation();
})

document.querySelector('.selector').addEventListener('mouseleave', event => {
    document.querySelector('.dropmenu').classList.toggle('hide');
    event.stopPropagation();
})