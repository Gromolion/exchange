let modal = document.getElementById('myModal');
let span = document.getElementsByClassName("close")[0];

span.onclick = function() {
    modal.style.display = "none";
}

modal.onclick = function(event) {
    if (event.target === modal) {
        modal.style.display = "none";
    }
}

document.querySelectorAll('.table_with_modal').forEach(tbody => {
    tbody.querySelectorAll('tr').forEach(row => {
        row.addEventListener('click', event => {
            document.querySelector('.modalrow').innerHTML = event.target.parentElement.innerHTML;
            const max_value = document.querySelector('.modalrow').querySelector('._count').dataset['count'];
            const inp = document.getElementById('row_id');
            inp.value = event.target.parentElement.id;
            document.getElementById('tentacles').max = max_value;
            modal.style.display = "block";
        })
    })
})
