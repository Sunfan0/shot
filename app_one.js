var app = require('http').createServer(handler)
var io = require('socket.io')(app);
var fs = require('fs');

// var server = {};
// var mobile = {};

var arrServer = new Array();
var arrMobile = new Array();
var serverId;

function mobile(){
	this.socket = "";      
    this.Aim = function(json){
	console.log("MobileAim , " + this.AimId)	
		data = json;
		this.AimPosition[this.AimId] = {};
		this.AimPosition[this.AimId].alpha = data.alpha;
		this.AimPosition[this.AimId].beta = data.beta;
	this.AimId += 1;
		arrServer[serverId].socket.emit('MobileAim',this.AimId);
		if(this.AimId > 4)
			this.AimOver();
	};
	this.AimOver = function(){
		this.AlphaTotal = 360 - this.AimPosition[2].alpha;
		this.BetaTotal = this.AimPosition[4].beta - this.AimPosition[2].beta;
		this.AlphaBegin = 0;
		this.BetaBegin = this.AimPosition[2].beta
		this.AlphaWidth = arrServer[serverId].WindowWidth / this.AlphaTotal;
		this.BetaHeight = arrServer[serverId].WindowHeight / this.BetaTotal;

		arrServer[serverId].socket.emit("AimOver","yes"); 		//校准位置是否正确   yes--校准成功  no--校准失败
		this.socket.emit("AimOver","over"); 		//校准完成
		this.IsAimOver = true;
	};
	this.Shot = function(data){
		p = {};
		p.l = (360 - data.alpha) * this.AlphaWidth;
		p.t = (data.beta - this.BetaBegin) * this.BetaHeight;
		arrServer[serverId].socket.emit('MobileShot',p);
	}
}

function server(){
	this.socket = "";      
	this.WindowWidth = "";      
	this.WindowHeight = ""
}

var Settings = {};

// app.listen(8060);
app.listen(8036);

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
		
		// mobile.socket = "";
		
		var serverNo = socket.id;
		serverId = socket.id;
		
		var newServer = new server();
		newServer.socket = socket;
		newServer.WindowWidth = data.windowWidth;
		newServer.WindowHeight = data.windowHeight;
		arrServer[serverNo] = newServer;
		arrServer[serverId].socket.emit('AccessSign', { "serverId" : serverNo});		//用户可以进入
console.log(arrServer);
	});
	
	socket.on('SignMobile',function(data){																		
console.log('SignMobile');
console.log(data);
		
		serverId = data.serverId;
		
		if(arrServer[data.serverId] == undefined)
			return;
		
		if(arrMobile[data.serverId] == undefined){
			var newmobile = new mobile();
			newmobile.socket = socket;
			newmobile.AimId = 1;
			newmobile.AimPosition = new Array();
			newmobile.IsAimOver = false;
			newmobile.socket.emit('AccessSign', { "Access" : "0" });		//用户可以进入
			arrMobile[data.serverId] = newmobile;
			
			arrServer[data.serverId].socket.emit('MobileJoin','0');
		}
	});

	socket.on('MobilePosition',function(data){
		serverId = data.serverId;
		
		if(arrMobile[data.serverId] == undefined)
			return;
		
		if(!arrMobile[data.serverId].IsAimOver)
			return;
		p = {};
		p.l = (360 - data.alpha) * arrMobile[data.serverId].AlphaWidth;
		p.t = (data.beta - arrMobile[data.serverId].BetaBegin) * arrMobile[data.serverId].BetaHeight;
		arrServer[data.serverId].socket.emit('MobilePosition',p);
	});
	
	socket.on('MobileShot',function(data){
		serverId = data.serverId;
		
		if(arrMobile[data.serverId] == undefined)
			return;
		
		if(arrMobile[data.serverId].AimId <= 4)
			arrMobile[data.serverId].Aim(data);
		else
			arrMobile[data.serverId].Shot(data);
	});
	socket.on('GameOver',function(data){
console.log('GameOver');
console.log(data);
		
		serverId = data.serverId;

		if(data.result == "close"){
			// arrServer[data.serverId].socket.emit('GameOverpc',data);
			if(arrMobile[data.serverId] == undefined)
				return;
			arrMobile[data.serverId].socket.emit('GameOvermobile',data);
		}else if(data.result == "reload"){
			arrServer[data.serverId].socket.emit('GameOverpc',data);
		}else if(data.result == "no"){
			if(arrMobile[data.serverId] == undefined)
				return;
			arrMobile[data.serverId].socket.emit('GameOvermobile',data);
			setTimeout(function(){
				arrServer[data.serverId].socket.emit('GameOverpc',data);
			},5000);
		}else{
			if(arrMobile[data.serverId] == undefined)
				return;
			arrMobile[data.serverId].socket.emit('GameOvermobile',data);
		}
		
		delete arrServer[data.serverId];
		
		if(arrMobile[data.serverId] != undefined){
			delete arrMobile[data.serverId];
		}
console.log(arrServer);
console.log(arrMobile);
	});
	socket.on('GetGift',function(data){
console.log('GetGift');
console.log(data);

		serverId = data.serverId;
		
		if(arrMobile[data.serverId] == undefined)
			return;
		
		arrServer[data.serverId].socket.emit('GetGiftpc',data);
		setTimeout(function(){
			arrServer[data.serverId].socket.emit('GameOverpc',data);
			arrMobile[data.serverId].socket = "";
		},5000);
	});
});