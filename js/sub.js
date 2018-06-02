$(function(){

	// read.php用処理
	if(document.URL.match('/create')) {
		console.log('sub.js : create -> ');
		var canvas = document.getElementById('mycanvas');
		if( !canvas || !canvas.getContext) return false;
		var ctx = canvas.getContext('2d');
		var paintFlag = "pen";
		var imageMemory = new Array(5);
		var flagMemory = 0;
		var count=0;
		$('#backBtn, #forwardBtn').attr('disabled', true);

		var startX, startY, x, y;
		var thisX, thisY;
		var borderWidth = 10;
		var isDrawing = false;
		var ImageData;
		var checkX=[];
		var checkY=[];
		var testX=[];
		var testY=[];
		var backupX=[];
		var backupY=[];
		saveImageData();
		ctx.lineWidth = '20';
		ctx.lineCap = "round";
		console.log(ctx);

		$('#mycanvas').on('touchstart mousedown', function(e){
			count += 1;
			console.log(count);

			e.preventDefault();
			thisX = e.pageX || e.originalEvent.changedTouches[0].pageX;
			thisY = e.pageY || e.originalEvent.changedTouches[0].pageY;

			startX = thisX - $(this).offset().left - borderWidth;
			startY = thisY - $(this).offset().top - borderWidth;

			checkX.push("!");
			checkY.push("!");
			checkX=[];
			checkY=[];


			if(paintFlag === "pen"){
				isDrawing = true;
				ctx.beginPath();
				ctx.moveTo(startX, startY);
			}

			if(paintFlag === "fill"){

				ImageData = ctx.getImageData(0,0,canvas.width,canvas.height);
				var colorCode = $('.color')[0].value;
				var rgbCode = new Array(3);
				rgbCode[0] = parseInt(colorCode.substr(0,2),16)
				rgbCode[1] = parseInt(colorCode.substr(2,2),16)
				rgbCode[2] = parseInt(colorCode.substr(4,2),16)
				console.log('colorValue-10進数:' + rgbCode);
				regionFill(ImageData, startX, startY, rgbCode);
				/*
				赤い点を打つ
				ImageData.data[(startY*ImageData.width+startX)*4] = 255;
				ImageData.data[(startY*ImageData.width+startX)*4+3] = 255;
				*/

				ctx.putImageData(ImageData, 0, 0);
			}
		})
		.on('touchmove mousemove',function(e){
			if(!isDrawing) return;
			e.preventDefault();
			thisX = e.pageX || e.originalEvent.changedTouches[0].pageX;
			thisY = e.pageY || e.originalEvent.changedTouches[0].pageY;
			x = thisX - $(this).offset().left - borderWidth;
			y = thisY - $(this).offset().top - borderWidth;

			checkX.push(x);
			checkY.push(y);
			//test
			testX[count-1]=checkX;
			testY[count-1]=checkY;
			backupX[count-1]=checkX;
			backupY[count-1]=checkY;
			console.log(testX);
			console.log(flagMemory);

			ctx.lineTo(x, y);
			ctx.stroke();
			startX = x;
			startY = y;

		})
		.on('touchend mouseup', function(){
			saveImageData();
			//console.log("touchend mouseup");
			isDrawing = false;
		})
		.on('touchleave mouseleave', function(e){
			//console.log("touchleave mouseleave");
			if(!isDrawing) return;
			saveImageData();
			e.preventDefault();
			thisX = e.pageX || e.originalEvent.changedTouches[0].pageX;
			thisY = e.pageY || e.originalEvent.changedTouches[0].pageY;
			x = thisX - $(this).offset().left - borderWidth;
			y = thisY - $(this).offset().top - borderWidth;

			console.log("x:" + x);
			console.log("y:" + y);

			//ctx.beginPath();
			ctx.translate(0.5,0.5);
			//ctx.moveTo(startX, startY);
			ctx.lineTo(x, y);
			ctx.stroke();
			startX = x;
			startY = y;

			isDrawing = false;
		});

		$('#erase').on('click', function(){
			if(!confirm('本当に消去しますか?')) return;
			checkX=[];
			checkY=[];
			count=0;
			ctx.clearRect(0,0,canvas.width, canvas.height);
		});


		$('#imaging').on('click', function(){
			console.log(checkX);
			console.log(checkY);
			//var dataUrl = canvas.toDataURL('image/png');
			//var w = window.open('check.php');
			//w.document.write("<img src='" + dataUrl + "'/>");
			//window.open($('#mycanvas')[0].toDataURL());
		});
	}


	//リプレイ
	// $('#replay').on('click', function(){
	// 	console.log("aa");
	// 	data = {mail:"aaa"};
	// 	$.ajax({
	// 		type: "POST",
	// 		url: "replay.php",
	// 		data: data,
	// 		success: function(data, dataType)
	// 		{
	// 			result=JSON.parse(data);
	// 			console.log(result);
	// 			//var k = /\_/;/\-/;
	// 			//var test= result.split(/-|;|\_/);
	// 			var test= result.split("_");
	// 			//console.log(test);
	// 			var Xend= test[0].split("-");
	// 			var Yend= test[1].split("-");
	// 			console.log(Xend);
	// 			console.log(Yend);
	// 			//ctx.lineTo(Xend[i], Yend[i]);
	// 			//ctx.stroke();
    //
	// 			for(var i=0;i<Xend.length;i++){
	// 				(function(){
	// 					var num=i-1;
	// 				setTimeout(function(){
	// 					if(Xend[num]!="!"){
	// 						ctx.lineTo(Xend[num], Yend[num]);
	// 						ctx.stroke();
	// 					}else{
	// 					   ctx.beginPath();
	// 						ctx.moveTo(Xend[num], Yend[num]);
	// 					 }
    //
	// 				}, 20 * i);
	// 			})();
	// 			}
	// 		},
	// 	});
	// });


	//リプレイ↑

	$('#posting').on('click', function(){
		console.log(count);
		console.log(testX);
		console.log(testY);
		testX = Array.prototype.concat.apply([],testX);
		testY = Array.prototype.concat.apply([],testY);
		console.log(testX);
		//画数
		$.ajax({
		type: "POST",
		url: "kaku.php",
		data: {co : count,
			   X:testX,
			   Y:testY},
		success: function(data, dataType)
		{
			//successのブロック内は、Ajax通信が成功した場合に呼び出される

			//PHPから返ってきたデータの表示
			// let result=JSON.parse(data);
			console.log(result);
		},

	});

	// バイナリ化した画像をPOSTで送る関数
	var sendImageBinary = function(blob) {
		var formData = new FormData();
		formData.append('acceptImage', blob);
		$.ajax({
			type: 'POST',
			url: 'image-accept2.php',
			data: formData,
			contentType: false,
			processData: false,
			success:function(date, dataType) {
				//console.log("succcess");
				console.log(date);
				window.location.href = 'option.php'; // 通常の遷移
				var $img = $('img');
				var imgSrc = $img.attr('src');
				$img.attr('src', "");
				$img.attr('src', imgSrc);
			},error: function(XMLHttpRequest, textStatus, errorThrown) {
				//console.log("error");
			}
		});
	};


		canvas = $('#mycanvas')[0].toDataURL();
		var base64Data = canvas.split(',')[1], // Data URLからBase64のデータ部分のみを取得
			data = window.atob(base64Data), // base64形式の文字列をデコード
			buff = new ArrayBuffer(data.length),
			arr = new Uint8Array(buff),
			blob, i, dataLen;

		// blobの生成
		for( i = 0, dataLen = data.length; i < dataLen; i++){
			arr[i] = data.charCodeAt(i);
		}
		blob = new Blob([arr], {type: 'image/png'});
		sendImageBinary(blob);
	});



	$('input[name="paintFlag"]').on('click', function(){
		paintFlag = $(this).data('paintflag');
		console.log(paintFlag);
	});

	// 現在のキャンバス状態を保存
	function saveImageData(){
		// 現在の状態を保存
		if(flagMemory == imageMemory.length-1){
			imageMemory.shift();
		}else{
			++flagMemory;
		}

		if(flagMemory == imageMemory.length-1){
			$('#forwardBtn').attr('disabled',true);
		}

		imageMemory[flagMemory] = ctx.getImageData(0,0,canvas.width,canvas.height);

		$('#backBtn').attr('disabled',false);
	}
	// 戻るボタン
	$('#backBtn').on('click', function(){
		if(flagMemory > 0){
			flagMemory--;
			count-=1;
			console.log(count);
			console.log("flagMemory;" + flagMemory);
			var exe = [count];    //削除したい位置（先頭が0であることに注意）
			for(var i=0; i<exe.length; i++){
				testX.splice(exe[i]-i, 1);
				testY.splice(exe[i]-i, 1);
			}
			console.log(testX);
			ctx.putImageData(imageMemory[flagMemory], 0, 0);

			$('#forwardBtn').attr('disabled', false);
			if(flagMemory==0){
				$('#backBtn').attr('disabled', true);
			}
		}
	});
	// 進むボタン
	$('#forwardBtn').on('click', function(){
		if(flagMemory < imageMemory.length-1){
			flagMemory++;
			console.log(count);
			testX[count]=backupX[count];
			testY[count]=backupY[count];
			count+=1;
			console.log(testX);
			console.log(backupX)
			ctx.putImageData(imageMemory[flagMemory], 0, 0);

			$('#backBtn').attr('disabled', false);
			if(flagMemory==imageMemory.length-1){
				$('#forwardBtn').attr('disabled', true);
			}
		}
	});

	// 色比較用関数
	function compareColor(ImageData, x, y,selectColorRGB,isAlpha){
		// xやyがcanvasの域内に収まっていなければfalseを返す
		if(x<0 || y<0 || x>=ImageData.width || y>=ImageData.height){
			return false;
		}

		var currentColorRGB = new Array(3);
		currentColorRGB[0] = ImageData.data[(y*ImageData.width+x)*4+0];
		currentColorRGB[1] = ImageData.data[(y*ImageData.width+x)*4+1];
		currentColorRGB[2] = ImageData.data[(y*ImageData.width+x)*4+2];
		var alphaInfo = ImageData.data[(y*ImageData.width+x)*4+3];

		if(alphaInfo !== 0){
			// 最初に選択した色と現在処理している色が違うならばfalseを返す
			if(selectColorRGB[0] !== currentColorRGB[0] ||
			  selectColorRGB[1] !== currentColorRGB[1] ||
			  selectColorRGB[2] !== currentColorRGB[2]){
				return false;
			}
			// 最初に選択した色が透明で現在処理中の色が透明でなければfalseを返す
			if(isAlpha){
				return false;
			}
		// 最初に選択した色が透明でなく、現在処理中の色が透明であればfalseを返す
		} else if(alphaInfo === 0 && !isAlpha){
			return false;
		}

		return true;
	}

});


//お題だし。
var disp="";
const odai_img = $('.odai__images__body');

$('.odai_btn').on('click', function() {

	odai_img.removeClass('show');

	var target = $(this).attr('data-target');
	//console.log(target);

	$("#odi_img1").text("");
	$("#odi_img2").text("");
	$("#odi_img3").text("");
	var rand=[];
	var min = 1 ;
	var max = 6 ;
	var min2=111;
	var max2=114;
	var hinto=[];

	/*
	for(var i=0;i<target;){
	if(rand.length==target){
		console.log("OK");
		//重複除去
		var rand = rand.filter(function (x, f, self) {
			return self.indexOf(x) === f;
		});
		if(rand.length==target){
			console.log("OK");
			i=9999;
		}
	}else{
		rand.push(Math.floor( Math.random() * (max + 1 - min) ) + min);
	}
	}
	*/
	if(1==target){
		//$('.odai__images__body.odai_img1').css('display','inline');
		$('.odai__images__body.odai_img1').css('display','none');
		$('.odai__images__body.odai_img2').css('display','none');
		$(document).ready(function() {
		$('.odai__images__body.odai_img1').fadeIn(300);
		});
		rand.push(Math.floor( Math.random() * (max + 1 - min) ) + min);
		//プレゼン用
		//rand.push(1);
	}
	if(2==target){
		console.log("中級");
		$('.odai__images__body.odai_img1').css('display','none');
		$('.odai__images__body.odai_img2').css('display','none');
		//$('.odai__images__body.odai_img1').css('display','inline');
		$(document).ready(function() {
		$('.odai__images__body.odai_img1').fadeIn(300);
		});
		$(document).ready(function() {
		$('.odai__images__body.odai_img2').fadeIn(420);
		});
		//$('.odai__images__body.odai_img2').css('display','inline');
		for(var i=0;i<target;){
			if(rand.length==target){
				console.log("OK");
				//重複除去
				var rand = rand.filter(function (x, f, self) {
					return self.indexOf(x) === f;
				});
				if(rand.length==target){
					console.log("OK");
					i=9999;
				}
			}else{
				rand.push(Math.floor( Math.random() * (max + 1 - min) ) + min);
			}
		}

		//rand.push(4);
		//rand.push(5);
	}
	if(3==target){
		console.log("上級");
		$('.odai__images__body.odai_img1').css('display','none');
		$('.odai__images__body.odai_img2').css('display','none');
		$(document).ready(function() {
		$('.odai__images__body.odai_img1').fadeIn(300);
		});
		$(document).ready(function() {
		$('.odai__images__body.odai_img2').fadeIn(420);
		});
		//$('.odai__images__body.odai_img1').css('display','inline');
		//$('.odai__images__body.odai_img2').css('display','inline');
		target-=1;
		for(var i=0;i<target;){
			if(rand.length==target){
				console.log("OK");
				//重複除去
				var rand = rand.filter(function (x, f, self) {
					return self.indexOf(x) === f;
				});
				if(rand.length==target){
					console.log("OK");
					i=9999;
				}
			}else{
				rand.push(Math.floor( Math.random() * (max + 1 - min) ) + min);
			}
		}
		rand.push(Math.floor( Math.random() * (max2 + 1 - min2) ) + min2);

		//rand.push(2);
		//rand.push(3);
		//rand.push(114);
	}
	console.log(rand);


	//ヒント
	for(var i=0;i<rand.length;i++){
		console.log("a");
		var himg = Math.floor( Math.random() * (3 + 1 - 1) ) + 1;
		if(i!=2){
			hinto.push('<img class="help_modal__content__img" src="images/hinto/'+rand[i]+'_'+himg+'.png" alt="hinto_img">');
		}
	}

	$("#hinto").append(hinto);

	$.ajax ({
		type: "POST",
		url: "odai.php",
		data: {co : rand},
		success: function(data, dataType) {
			var result=JSON.parse(data);
			$("#odai_text").html(result[1]);
			//お題画像表示
			$("#odi_img1").html(result[2]);
			//中級お題
			if(result[3]!=""){
				$("#odi_img2").html(result[3]);
			} else {
				console.log("not success");
			}
		},
	}, 5000, odai_img.each(function() {
			$(this).addClass('show');
	}));
});

//ソート
$('#sort_up').on('click',function() {
	console.log("up");
	sort("ASC");
});
$('#sort_down').on('click',function() {
	console.log("down");
	sort("DESC");
});
function sort(e){
	console.log(e);
};
