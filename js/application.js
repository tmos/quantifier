/** Initialisation of the application */
var App = Ember.Application.create({
    LOG_TRANSITIONS: true
});

/** Routers */
App.Router.map(function() {
    this.route('tracks');
    this.route('track', { path: '/tracks/:id' });
});

/** Controllers */
App.ApplicationController = Ember.Controller.extend({
    pageName : "Quantifier",
    userName : "tmos"
});

App.IndexController = Ember.Controller.extend({
    pageName : "Accueil",
    userName : "tmos"
});
App.TracksController = Ember.Controller.extend({
    pageName : "Tracks"
    // Create a function that return a set-up canvas with chart.JS
});

/** Routes */
App.TracksRoute = Ember.Route.extend({
  model: function() {
    return App.TRACKS;
  }
});

App.TRACKS = [
    {
        id:1,
        title:"Pages read",
        creationDate:"26/10/1992",
        type:1,
        values:
        [
            12,
            34,
            67,
            89,
            12,
            34,
            98,
            15,
            62,
            93,
            45
        ]
    }, {
        id:2,
        title:"km runs",
        creationDate:"26/04/2014",
        type:1,
        values:
        [
            12.5,
            24.3,
            42,
            8,
            23
        ]
    }, {
        id:3,
        title:"Beverages",
        creationDate:"26/10/1992",
        type:2,
        values:
        {
            "Biere": 28,
            "Vin": 1,
            "Eau": 234
        }
    }, {
        id:4,
        title:"Beverages",
        creationDate:"26/10/1992",
        type:2,
        values:
        {
            "Biere": 28,
            "Vin": 1,
            "Eau": 234
        }
    }
];