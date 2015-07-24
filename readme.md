### Overview of task
Create a plugin that displays a list of movies, with the following taks:  

- Create a JSON API from  a custom post type. 
- Displays the movies as a frontpage (home page of the site) using the JSON API created in the previous task.

### Data / Specification
- Custom Post Type: Movie
- Fields / Meta Data of CPT
  - poster_url: a string to the url of an image associated with that movie
  - rating: a number rating / score of the value of that respective movie
  - year: date of release 
  - description: short html description of the movie
- Page should automatically display on home page
- Logic for no movies, etc
- Simple documentation for using the plugin
- Structure should look like:

```json
{
  data: [
     {
        id: 1
        title: 'UP'
        poster_url: ‘http://localhost.dev/images/up.jpg’,
        rating: 5,
        year: 2010
        short_description: ‘Phasellus ultrices nulla quis nibh. Quisque a lectus',
     },
     {
        id: 2
        title: 'Avatar'
        poster_url: ‘http://localhost.dev/images/avatar.jpg’,
        rating: 3,
        year: 2012
        short_description: ‘Phasellus ultrices nulla quis nibh. Quisque a lectus',
     }
     …
  ]
}
```


### Bonus for
- Angular or other SPA frameworks for displaying movies
- Caching of the API for movies (cleared upon adding new movie)
- Fancy UI Effects / Animations / Etc.
- Follow WordPress coding standards
- PHP Unit tests
- TravisCI or Circle CI integration

