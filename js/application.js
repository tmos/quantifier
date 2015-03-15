/** Initialisation and configuration */
var App = Ember.Application.create({
    LOG_TRANSITIONS: true
});

App.ApplicationAdapter = DS.FixtureAdapter.extend();

/** Routers */
App.Router.map(function() {
    this.route('login');
    this.route('signup');
    this.resource('settings');
    this.resource('tracks');
    this.resource('track', { path: 'tracks/:track_id' });
    this.resource('proportions');
    this.resource('proportion', { path: 'proportions/:proportion_id' });
});

/** Controllers */
App.ApplicationController = Ember.Controller.extend({
    userName : "tmos"
});

App.IndexController = Ember.Controller.extend({
    
});

App.TracksController = Ember.ArrayController.extend({
    getGraph: function(graphId){
        var track = this.store.find('id', graphId);
        var data = {
            datasets:
            [
                {
                    label: track.get('title'),
                    fillColor: "rgba(220,220,220,0.2)",
                    strokeColor: "rgba(220,220,220,1)",
                    pointColor: "rgba(220,220,220,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: track.get('values')
                }
            ]
        };
        return new Chart(ctx).Line(data, options)
    }.property()
});


/** Routes */
App.TracksRoute = Ember.Route.extend({
    model: function() {
        return this.store.findAll('track');
    },
    afterModel: function() {
        var model = this.store.findAll('track');
        console.log(model);

        for (var i = model.length - 1; i >= 0; i--) {
            console.log(model[i].get('id'));
            $("#"+model[i].get('id')) = getGraph(model[i]);
        };
    }
});

/** Models */
App.Track = DS.Model.extend({
    title: DS.attr('string'),
    creationDate: DS.attr('string'),
    type: DS.attr('number'),
    values: DS.attr('array'),
});
App.Track.FIXTURES = [
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

App.Proportion = DS.Model.extend({
    title: DS.attr('string'),
    creationDate: DS.attr('string'),
    tracks: DS.hasMany('track'),
});
App.Proportion.FIXTURES = [
    {
        title:"test proportion",
        creationDate:"26/10/1992",
        tracks: [1,2]
    }
];