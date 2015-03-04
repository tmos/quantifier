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
App.IndexController = Ember.Controller.extend({
    userName : "tmos"
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
    }
];