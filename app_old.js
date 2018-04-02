var app = require('http').createServer(handler)
var io = require('socket.io')(app);
var fs = require('fs');

var server = {};
var mobile = {};
mobile.Aim = function(json){
	//data = $.parseJSON(json)
console.log("MobileAim , " + mobile.AimId)	
	data = json;
	mobile.AimPosition[mobile.AimId] = {};
	mobile.AimPosition[mobile.AimId].alpha = data.alpha;
	mobile.AimPosition[mobile.AimId].beta = data.beta;
mobile.AimId += 1;
	server.socket.emit('MobileAim',mobile.AimId);
	if(mobile.AimId > 4)
		mobile.AimOver();
}
mobile.AimOver = function(){
	mobile.AlphaTotal = 360 - mobile.AimPosition[2].alpha;
	mobile.BetaTotal = mobile.AimPosition[4].beta - mobile.AimPosition[2].beta;
	mobile.AlphaBegin = 0;
	mobile.BetaBegin = mobile.AimPosition[2].beta
	mobile.AlphaWidth = server.WindowWidth / mobile.AlphaTotal;
	mobile.BetaHeight = server.WindowHeight / mobile.BetaTotal;
console.log(mobile);
	server.socket.emit("AimOver","");
	mobile.IsAimOver = true;
	//$("#divAimContainer").addClass("hidden");
	//BeginGame();
}
mobile.Shot = function(data){
	p = {};
	p.l = (360 - data.alpha) * mobile.AlphaWidth;
	p.t = (data.beta - mobile.BetaBegin) * mobile.BetaHeight;
	server.socket.emit('MobileShot',p);
}

var Settings = {};

app.listen(8060);

function handler (req, res) {
  fs.readFile(__dirname + '/index.html',
  function (err, data) {
    if (err) {
      res.writeHead(500);
      return res.end('Error loading index.html');
    }

    res.writeHead(200);
    res.end(data);
  });
}

io.on('connection', function (socket) {
	socket.emit('news', { hello: 'world' });

	socket.on('my other event', function (data) {
		console.log(data);
	});

	socket.on('Init',function(data){
		socket.emit('news', { hello: 'world' });
	});
	
	socket.on('SignServer',function(data){
console.log('SignServer');
console.log(data);
		//d = JSON.parse(data);
		server.socket = socket;
		server.WindowWidth = data.windowWidth;
		server.WindowHeight = data.windowHeight;
		socket.emit('AccessSign', { "Access" : data });
	});
	
	socket.on('SignMobile',function(data){
console.log('SignMobile');
console.log(data);
		mobile.socket = socket;
		socket.emit('AccessSign', { "Access" : data });
		mobile.AimId = 1;
		mobile.AimPosition = new Array();
		mobile.IsAimOver = false;
		server.socket.emit('MobileJoin','');
	});

	socket.on('MobilePosition',function(data){
		if(!mobile.IsAimOver)
			return;
		p = {};
		p.l = (360 - data.alpha) * mobile.AlphaWidth;
		p.t = (data.beta - mobile.BetaBegin) * mobile.BetaHeight;
		server.socket.emit('MobilePosition',p);
	});
	
	socket.on('MobileShot',function(data){
console.log('MobileShot');
console.log(data);
console.log("mobile.AimId = " + mobile.AimId);
		if(mobile.AimId <= 4)
			mobile.Aim(data);
		else
			mobile.Shot(data);
	});
	socket.on('GameOver',function(data){
console.log(data);
		socket.emit('GameOvermobile',{"result":"12"});
	});
});