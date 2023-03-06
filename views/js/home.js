
function searchMovie() {

    let filterMovie = document.querySelector('#filterMovie').value

    let url = `${URI}?${KEY}&s=${filterMovie}`

    fetch(url)
        .then(result => result.json())
        .then(data => {
            if (typeof data.Error != 'undefined') {
                MOVIES.searches = []
            } else {
                MOVIES.searches = data.Search
            }
            render()
        })
        .catch(error => {
            console.log(error)
        })
};


function miMovies() {

    fetch("jcmovies/mi-movies")
        .then(result => result.json())
        .then(data => {
            if (typeof data.Error != 'undefined') {
                MOVIES.searches = []
            } else {
                MOVIES.searches = data.Search
            }
            render()
        })
        .catch(error => {
            console.log(error)
        })
};


function render() {
    let cardsContent = document.querySelector('#cards-content')
    let cards = ''

    if (MOVIES.searches.length > 0) {

        let cardsMovie = document.querySelector('#cards-movie')

        MOVIES.searches.forEach(movie => {
            let card = MOVIES.cardTemplate
                .replace('{{Poster}}', movie.Poster)
                .replace('{{Title}}', movie.Title)
                .replace('{{Year}}', movie.Year)
                .replace('{{idMovie}}', movie.imdbID)
                .replace(/{{action}}/g, MOVIES.action)

            cards += card;
        });

        cardsMovie.innerHTML = cards
        cardsContent.classList.remove('hide')

    } else {
        cardsContent.classList.add('hide')
        alert("No se encontraron resultados")
    }

}

function addOrRemove(event) {
    let idMovie = event.target.id
    let action = event.target.name
    let movie = MOVIES.searches.filter(movie => movie.imdbID == idMovie)

    action = (action == 'Agregar') ? 'POST' : 'DELETE'
    let uri = (action == 'POST') ? '' : (`/${idMovie}`)

    let payload = {
        method: action,
        body: JSON.stringify(movie.shift())
    }

    fetch('/jcmovies/my-movies' + uri, payload)
        .then(result => result.json())
        .then(data => {

            if (data.httpCode == 400) {

                alert("ERROR: " + data.message)
            } else {
                alert(data.message)
            }
        })
        .catch(error => console.log(error))
}

fetch('/jcmovies/views/home/_cardMovie.html')
    .then(result => result.text())
    .then(data => MOVIES.cardTemplate = data)
    .catch(error => console.log(error))

setTimeout(() => {
    render()
}, 50);