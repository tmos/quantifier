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
    userName : "tmos"
});

App.IndexController = Ember.Controller.extend({
    
});
App.TracksController = Ember.Controller.extend({

});


/** Routes */
App.TracksRoute = Ember.Route.extend({
    model: function() {
        return App.TRACKS;
    }
});
App.TrackRoute = Ember.Route.extend({
    model: function(params) {
        return App.TRACKS.findBy('id', params.id); 
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