// style.js 主にHTML,CSSに関係するJS

// 最初のページローディング
$(window).bind('load', function() {
	if(document.URL.match('/read')) {
	}

    //投稿完了ページ表示前にロード画面を表示
	if(document.URL.match('/comp')) {
		console.log('main.js : comp -> ');
		$("#fakeLoader").fakeLoader({
			   timeToHide:1200, //Time in milliseconds for fakeLoader disappear
			   zIndex:999, // Default zIndex
			   spinner:"spinner2",//Options: 'spinner1', 'spinner2', 'spinner3', 'spinner4', 'spinner5', 'spinner6', 'spinner7'
			   bgColor:"#4DB6AC", //Hex, RGB or RGBA colors
			   // imagePath:"../images/loadinfo.net.gif" //If you want can you insert your custom image
		 });
	}
});


// リサイズ時の取得
// ただし画面サイズ変更をした場合はcanvasの設定が初期化されるので更新ボタンを必ずする
$(window).on('load resize', function(){
	console.log('main.js : resized -> ');
	// ポップアップのcanvasを取得
	//リサイズ時の大きさ設定
	const panel = $('.popup_trigger');
	let w2 = panel.find('.panel__canvas_body.active').width();
	let h2 = panel.find('.panel__canvas_body.active').height();
	panel.find('.kanji_canvas').attr('width', w2);
	panel.find('.kanji_canvas').attr('height', h2);
});


$(function() {
	// ページ遷移時のアニメーション > create.php

    // 検索及び並び替え時のアニメーション > read.php


    // 登録完了ページのアニメーション > comp.php
	if(document.URL.match('/read')) {
		console.log('main.js : read -> ');


		// 漢字パネルのフェードイン表示
		//初期表示
		$('.panel').each(function(i) {
			let imgPos = $(this).offset().top;
			let windowHeight = $('.read_area').height();
			if (imgPos < windowHeight) {
				$(this).addClass('visible');
			} else {
				$(this).removeClass('visible');
			}
		});
		// スクロールイベント
		$('.read_area').on('scroll', function () {
			$('.panel').each(function(i) {
				let imgPos = $(this).offset().top;
				let scroll = $('.read_area').scrollTop();
				let windowHeight = $('.read_area').height();
				// if (scroll > imgPos - windowHeight + 50) {
				if (imgPos < windowHeight) {
					$(this).addClass('visible');
				} else {
					$(this).removeClass('visible');
				}
			});
		});

		// cssに設定しているアニメーション名の配列
		let animationArray = ['kanji_rotate'];
		$('.panel').each(function() {
			console.log($(this).find('.panel__img'));
			// 配列からランダムに取得
			let setAnimation = animationArray[Math.floor(Math.random() * animationArray.length)];
			console.log(setAnimation);
			$(this).addClass(setAnimation);
		});

		//漢字パネル拡大表示　+ お題表示
		$('.popup_trigger').on('click',function() {
			console.log('main.js : read -> popup_trigger -> ');
			// $('.modal_bg, .modal').addClass('open');
			const panel = $(this);
			panel.find('.panel__default').addClass('hide');
			panel.addClass('active');
			// panel.find('.panel__img').hide();
			panel.find('.panel__img, .panel__canvas_body, .panel__popup').addClass('active');
			$('.control_btn__search').css('opacity', '0');
			$('.control_btn__search, .search_modal').hide();
			$('#searchToggle').prop('disabled', true);
			$('.panel:not(.active)').css('opacity', '0');
			$('.popup_close_btn').addClass('active');

			// 開いたと同時にcanvasサイズを取得
			let w2 = panel.find('.panel__canvas_body').width();
			let h2 = panel.find('.panel__canvas_body').height();
			panel.find('.kanji_canvas').attr('width', w2);
			panel.find('.kanji_canvas').attr('height', h2);

			// このkanjiのデータベースと同一IDを取得
			let targetPass = panel.attr('data-target');
			targetPass= targetPass.split("a");
			targeti=targetPass[1];
			targetPass=targetPass[0];
			 // 漢字パネル内のcanvasの設定
			console.log(targetPass);
			console.log(targeti);
			 var canvas = document.getElementById('kanjiCanvas'+targeti);
			 if( !canvas || !canvas.getContext) {
				 alert('canvas要素を取得できませんでした');
				 return false;
			 };
			 var ctx = canvas.getContext('2d');
			 var paintFlag = "pen";
			 var checkX=[];
			 var checkY=[];
			 //saveImageData();
			 ctx.lineWidth = '20';
			 ctx.lineCap = "round";
			 console.log(ctx);

	 		// リプレイ開始
			replay(ctx, targetPass);

			//閉じる　閉じるボタンをクリック
			$('#popupClose').on('click',function() {
				console.log('main.js : read -> popupClose -> ');
				$('.popup_close_btn').css('oapcity', '0');
				$('.popup_close_btn').removeClass('active');
				$('.panel:not(.active)').css('opacity', '1');
				$('.control_btn__search, .search_modal').show();
				$('.control_btn__search').css('opacity', '1');
				$('#searchToggle').prop('disabled', false);
				$('.popup_trigger').css('pointer-events','auto');
				panel.find('.panel__img, .panel__canvas_body, .panel__popup').removeClass('active');
				panel.removeClass('active');
				panel.find('.panel__default').removeClass('hide');
			});
		});

		//リプレイ and canvas
		let count;
		// $('#kanjiCanvas').on('touchstart mousedown', function(e){
		// 	console.log('main.js : touchstart mousedown -> ');
		// 	count += 1;
		// 	console.log(count);
        //
		// 	e.preventDefault();
		// 	thisX = e.pageX || e.originalEvent.changedTouches[0].pageX;
		// 	thisY = e.pageY || e.originalEvent.changedTouches[0].pageY;
        //
		// 	startX = thisX - $(this).offset().left - borderWidth;
		// 	startY = thisY - $(this).offset().top - borderWidth;
        //
		// 	checkX.push("!");
		// 	checkY.push("!");
        //
		// 	if(paintFlag === "pen"){
		// 		isDrawing = true;
		// 		ctx.beginPath();
		// 		ctx.moveTo(startX, startY);
		// 	}
        //
		// 	if(paintFlag === "fill"){
        //
		// 		ImageData = ctx.getImageData(0,0,canvas.width,canvas.height);
		// 		var colorCode = $('.color')[0].value;
		// 		var rgbCode = new Array(3);
		// 		rgbCode[0] = parseInt(colorCode.substr(0,2),16)
		// 		rgbCode[1] = parseInt(colorCode.substr(2,2),16)
		// 		rgbCode[2] = parseInt(colorCode.substr(4,2),16)
		// 		console.log('colorValue-10進数:' + rgbCode);
		// 		regionFill(ImageData, startX, startY, rgbCode);
		// 		/*
		// 			赤い点を打つ
		// 			ImageData.data[(startY*ImageData.width+startX)*4] = 255;
		// 			ImageData.data[(startY*ImageData.width+startX)*4+3] = 255;
		// 		*/
        //
		// 		ctx.putImageData(ImageData, 0, 0);
		// 	}
		// });
	}

	// create.php用の処理
	if(document.URL.match('/create')) {
		console.log('main.js : create -> ');

		//canvas　画面サイズに対応する為の処理
		let w = $('#createCanvasBody').width();
		let h = $('#createCanvasBody').height();
		$('#mycanvas').attr('width', w);
		$('#mycanvas').attr('height', h);

	    // お題画像の初期状態
		const odai_body = $('.odai__images__body');

	 	odai_body.each(function() {
			$(this).addClass('show');

			let bushu_img = $(this).find('.bushu_img');
	        // imgタグのwidth値を直接参照するとalt属性がある場合にうまく判定できないので、
			// 生成したImageオブジェクトにimgタグをコピーしてwidth値を判定する
			let img_check = new Image();
			img_check.src = bushu_img.src;

			if(img_check.width == 0) {
	            // 画像サイズが０の場合初期状態を表示
				bushu_img.css('opacity', '0');
				$(this).find('.bushu_yomi').html('NO IMAGE');
			} else {
				bushu_img.css('opacity', '1');
			}
		});

	    // お題ボタンの難易度の反映
		$('.odai_btn').on('click', function() {

			// お題本文のエフェクト
			if($(this).hasClass('easy')) {
				$('.odai__content__highlight').addClass('active_blue');
			} else if($(this).hasClass('normal')) {
				$('.odai__content__highlight').addClass('active_green');
			} else {
				$('.odai__content__highlight').addClass('active_red');
			}
	        // 一定時間経過後エフェクトのクラスを削除
			setTimeout(function() {
				$('.odai__content__highlight').removeClass('active_blue');
				$('.odai__content__highlight').removeClass('active_green');
				$('.odai__content__highlight').removeClass('active_red');
			 }, 500);
		});
	}


    // ラベルのアニメーション
	// inputのvalueに値がある場合 labelに.label_actionを追加
	$('.form__group__input').on('change', function() {
		console.log('main.js : form__group__input on click -> ');
		let target = $(this).attr('name');
		if($(this).val() != '') {
			$('.form__group__label').each(function(i, elem) {
				if($(this).hasClass(target)) {
					$(this).addClass('label_action');
					return true;
				}
			});
		} else {
			$('.form__group__label').each(function(i, elem) {
				if($(this).hasClass(target)) {
					$(this).removeClass('label_action');
					return true;
				}
			});
		}
	});

	// //リップルエフェクトの設定
	$('.embossed_btn,control_btn').mousedown(function (e) {
	    var target = e.target;
	    var rect = target.getBoundingClientRect();
	    var ripple = target.querySelector('.ripple');
	    $(ripple).remove();
	    ripple = document.createElement('span');
	    ripple.className = 'ripple';
	    ripple.style.height = ripple.style.width = Math.max(rect.width, rect.height) + 'px';
	    target.appendChild(ripple);
	    var top = e.pageY - rect.top - ripple.offsetHeight / 2 -  document.body.scrollTop;
	    var left = e.pageX - rect.left - ripple.offsetWidth / 2 - document.body.scrollLeft;
	    ripple.style.top = top + 'px';
	    ripple.style.left = left + 'px';
	    return false;
	});
});



function replay(ctx, targetPass) {
	console.log('main.js : func(replay) -> ');
	console.log(targetPass);
	let test;
	let Xend = [];
	let Yend= [];

	data = {'kanjiPass':targetPass};
	$.ajax({
		type: "POST",
		url: "replay.php",
		data: data,
		success: function(data, dataType) {
			result=JSON.parse(data);
			//console.log(result);
		 	test= result.split("_");
			Xend= test[0].split("-");
			Yend= test[1].split("-");
			//console.log(Xend);
			//console.log(Yend);

			var time=Xend.length;

            // リプレイが終わるまでパネルのタッチ操作を無効にする
			$('.popup_trigger').css('pointer-events','none');
			setTimeout(function() {
				console.log("aa");
				$('.popup_trigger').css('pointer-events','auto');
			}, 20*time+300);

			for(var i=0;i<time;i++) {
				(function() {
					var num=i-1;

					setTimeout(function() {
						if(Xend[num]!="!"){
							ctx.lineTo(Xend[num], Yend[num]);
							ctx.stroke();
						} else {
						   ctx.beginPath();
							ctx.moveTo(Xend[num], Yend[num]);
						}
					}, 20 * i);
				})();
			}
		},
	});
};
//リプレイ
