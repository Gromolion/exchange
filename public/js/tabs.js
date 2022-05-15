// document.getElementById('s1').classList.add('selected')

document.querySelectorAll('.selector').forEach(selector => {
    selector.addEventListener('click', event => {
        document.querySelectorAll('.dtable').forEach(table => {
            if (!table.classList.contains('hide')) {
                table.classList.add('hide');
                document.querySelectorAll('.selector').forEach(selector => {
                    if (event.target.id !== selector.id) {
                        selector.classList.remove('selected');

                    }
                })
            }
            if(event.target.id[1] === table.id[1]) {
                event.target.classList.add('selected');
                table.classList.remove('hide');
            }
        })
    })
})
