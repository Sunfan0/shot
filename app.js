var app = require('http').createServer(handler)
var io = require('socket.io')(app);
var fs = require('fs');

var server = {};
var mobile = {};
mobile.socket = "";
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
// console.log(mobile);

	// var data = mobile.AimPosition;
	// var newData = new Array();
	// for(i=1;i<=4;i++){
		// var m = {};
		// m.l = (360 - data[i].alpha) * mobile.AlphaWidth;
		// m.t = (data[i].beta - mobile.BetaBegin) * mobile.BetaHeight;
		// newData.push(m);
	// }
	
// console.log(data);
// console.log(newData);

	// if(data[1].alpha > data[2].alpha && data[3].alpha > data[4].alpha && data[1].beta > data[3].beta && data[2].beta > data[4].beta){
	// if(newData[0].l < newData[1].l && newData[2].l < newData[3].l && newData[0].t < newData[2].t && newData[1].t < newData[3].t){
		// server.socket.emit("AimOver","yes"); 		//校准位置是否正确   yes--校准成功  no--校准失败
// console.log("yes");
	// }else{
		// server.socket.emit("AimOver","no"); 		//校准位置是否正确   yes--校准成功  no--校准失败
// console.log("no");
	// }
	
	server.socket.emit("AimOver","yes"); 		//校准位置是否正确   yes--校准成功  no--校准失败
	
	mobile.socket.emit("AimOver","over"); 		//校准完成
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

// app.listen(8060);
app.listen(8003);

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
		mobile.socket = "";
		server.socket = socket;
		server.WindowWidth = data.windowWidth;
		server.WindowHeight = data.windowHeight;
		socket.emit('AccessSign', { "Access" : '0' });		//用户可以进入
	});
	
	socket.on('SignMobile',function(data){
console.log('SignMobile');
console.log(data);
// console.log(mobile.socket);
// console.log('mobile.socket');

		if(mobile.socket == ""){
			mobile.socket = socket;
			socket.emit('AccessSign', { "Access" : "0" });		//用户可以进入
			mobile.AimId = 1;
			mobile.AimPosition = new Array();
			mobile.IsAimOver = false;
			server.socket.emit('MobileJoin','0');
		}
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
console.log('GameOver');
console.log(data);
		if(data.result == "close"){
			server.socket.emit('GameOverpc',data);
			mobile.socket = "";
		}else if(data.result == "reload"){
			server.socket.emit('GameOverpc',data);
			mobile.socket = "1";
		}else if(data.result == "no"){
			mobile.socket.emit('GameOvermobile',data);
			setTimeout(function(){
				server.socket.emit('GameOverpc',data);
				mobile.socket = "";
			},5000);
		}else{
			mobile.socket.emit('GameOvermobile',data);
			// setTimeout(function(){
				// server.socket.emit('GameOverpc',data);
				// mobile.socket = "";
			// },5000);
		}
	});
	socket.on('GetGift',function(data){
console.log('GetGift');
console.log(data);
		server.socket.emit('GetGiftpc',data);
		setTimeout(function(){
			server.socket.emit('GameOverpc',data);
			mobile.socket = "";
		},5000);
	});
});