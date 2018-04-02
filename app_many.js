var app = require('http').createServer(handler)
var io = require('socket.io')(app);
var fs = require('fs');

var server = {};
var arrMobile = new Array();
var openid = "";

// var mobile = {};


function mobile(){  
    this.socket = "";      
    this.Aim = function(json){
		//data = $.parseJSON(json)
console.log("MobileAim , " + this.AimId)
		data = json.p;
		openid = json.openid;
console.log(openid);
		this.AimPosition[this.AimId] = {};
		this.AimPosition[this.AimId].alpha = data.alpha;
		this.AimPosition[this.AimId].beta = data.beta;
	this.AimId += 1;
		// server.socket.emit('MobileAim',this.AimId);
		this.socket.emit('MobileAim',this.AimId);
		if(this.AimId > 4)
			this.AimOver(json);
	}; 
	this.AimOver = function(json){
		openid = json.openid;
console.log(openid);
		this.AlphaTotal = 360 - this.AimPosition[2].alpha;
		this.BetaTotal = this.AimPosition[4].beta - this.AimPosition[2].beta;
		this.AlphaBegin = 0;
		this.BetaBegin = this.AimPosition[2].beta
		this.AlphaWidth = server.WindowWidth / this.AlphaTotal;
		this.BetaHeight = server.WindowHeight / this.BetaTotal;
		
		server.socket.emit("AimOver",json); 		//校准位置是否正确   yes--校准成功  no--校准失败
		
		this.socket.emit("AimOver",json); 		//校准完成
		this.IsAimOver = true;
		
		setTimeout(function(){
			server.socket.emit('GameOverpc',json);
		},60000)
		setTimeout(function(){
			delete arrMobile[openid];
		},60000+3000)
	};  
	this.Shot = function(json){
		data = json.p;
		openid = json.openid;
console.log(openid);
		p = {};
		p.l = (360 - data.alpha) * this.AlphaWidth;
		p.t = (data.beta - this.BetaBegin) * this.BetaHeight;
		server.socket.emit('MobileShot',{ "p" : p ,"openid" : json.openid});
	}
} 

/*

var mobile = {
	socket: "",
	Aim: function(json){
		//data = $.parseJSON(json)
	console.log("MobileAim , " + this.AimId)
		data = json.p;
		openid = json.openid;
console.log(openid);
		this.AimPosition[this.AimId] = {};
		this.AimPosition[this.AimId].alpha = data.alpha;
		this.AimPosition[this.AimId].beta = data.beta;
	this.AimId += 1;
		// server.socket.emit('MobileAim',this.AimId);
		this.socket.emit('MobileAim',this.AimId);
		if(this.AimId > 4)
			this.AimOver(json);
	},
	AimOver: function(json){
		openid = json.openid;
console.log(openid);
		this.AlphaTotal = 360 - this.AimPosition[2].alpha;
		this.BetaTotal = this.AimPosition[4].beta - this.AimPosition[2].beta;
		this.AlphaBegin = 0;
		this.BetaBegin = this.AimPosition[2].beta
		this.AlphaWidth = server.WindowWidth / this.AlphaTotal;
		this.BetaHeight = server.WindowHeight / this.BetaTotal;
		
		server.socket.emit("AimOver",json); 		//校准位置是否正确   yes--校准成功  no--校准失败
		
		this.socket.emit("AimOver",json); 		//校准完成
		this.IsAimOver = true;
	},
	Shot: function(json){
		data = json.p;
		openid = json.openid;
console.log(openid);
		p = {};
		p.l = (360 - data.alpha) * this.AlphaWidth;
		p.t = (data.beta - this.BetaBegin) * this.BetaHeight;
		server.socket.emit('MobileShot',{ "p" : p ,"openid" : json.openid});
	}
};*/

var Settings = {};

// app.listen(8060);
app.listen(8033);

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
		
		server.socket = socket;
		server.WindowWidth = data.windowWidth;
		server.WindowHeight = data.windowHeight;
		socket.emit('AccessSign', { "Access" : '0' });		//用户可以进入
	});
	
	socket.on('SignMobile',function(data){
console.log('SignMobile');
console.log(data.openid);
console.log(data.headimgurl);
// console.log(mobile.socket);
// console.log('mobile.socket');
		
			openid = data.openid;
			
// arrMobile[openid] = new mobile();
	
			var Newmobile = new mobile();
			// var Newmobile = new Object();

			Newmobile.socket = socket;
			socket.emit('AccessSign', { "Access" : "0" });		//用户可以进入
			Newmobile.AimId = 1;
			Newmobile.AimPosition = new Array();
			Newmobile.IsAimOver = false;
			server.socket.emit('MobileJoin',{ "join" : "0" , "headimgurl" : data.headimgurl , "openid" : data.openid});
console.log("MobileJoin");
		
		// if(mobile.socket == ""){
			// arrMobile[openid].socket = socket;
			// socket.emit('AccessSign', { "Access" : "0" });		//用户可以进入
			// arrMobile[openid].AimId = 1;
			// arrMobile[openid].AimPosition = new Array();
			// arrMobile[openid].IsAimOver = false;
			// server.socket.emit('MobileJoin',{ "join" : "0" , "headimgurl" : data.headimgurl , "openid" : data.openid});
// console.log("MobileJoin");
		// }
		
		arrMobile[openid] = Newmobile;
		
console.log("arrMobile");
console.log(arrMobile);
	});

	socket.on('MobilePosition',function(data){
		openid = data.openid;
		var newdata = data.p;
		if(arrMobile[openid] == undefined)
			return;
		if(!arrMobile[openid].IsAimOver)
			return;
		p = {};
		p.l = (360 - newdata.alpha) * arrMobile[openid].AlphaWidth;
		p.t = (newdata.beta - arrMobile[openid].BetaBegin) * arrMobile[openid].BetaHeight;
		server.socket.emit('MobilePosition',{ "p" : p ,"openid" : data.openid});
	});
	
	socket.on('MobileShot',function(data){
console.log('MobileShot');
console.log(data);
// console.log("arrMobile[openid].AimId = " + arrMobile[openid].AimId);

		openid = data.openid;
		
		if(arrMobile[openid] == undefined)
			return;
		
		if(arrMobile[openid].AimId <= 4)
			arrMobile[openid].Aim(data);
		else
			arrMobile[openid].Shot(data);
	});
	socket.on('GameOver',function(data){
console.log('GameOver');
console.log(data);

		openid = data.openid;
		if(arrMobile[openid] == undefined)
			return;
		
		if(data.result == "close"){
			server.socket.emit('GameOverpc',data);
		}else if(data.result == "reload"){
			server.socket.emit('GameOverpc',data);
		}else if(data.result == "over"){
			server.socket.emit('GameOverpc',data);
		}else if(data.result == "no"){
			arrMobile[openid].socket.emit('GameOvermobile',data);
			setTimeout(function(){
				server.socket.emit('GameOverpc',data);
			},5000);
		}else{
			arrMobile[openid].socket.emit('GameOvermobile',data);
		}
	});
	socket.on('GetGift',function(data){
console.log('GetGift');
console.log(data);

		openid = data.openid;
		if(arrMobile[openid] == undefined)
			return;
		
		server.socket.emit('GetGiftpc',data);
		setTimeout(function(){
			server.socket.emit('GameOverpc',data);
			arrMobile.splice(openid,1);
		},5000);
	});
});