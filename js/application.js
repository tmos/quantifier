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