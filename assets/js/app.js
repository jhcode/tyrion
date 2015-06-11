var msgInterval, base = $('base').attr('href');
var files;
var drop;
var note_info = new Array();

$(document).ready(function(){

	$(document).on('click','.attachcomment a[name="hide"]',function(){
		$(this).parents('.txtright').fadeOut('slow',function(){});
		$('.attachcomment a[name="show"]').parents('.attachcomment').fadeIn('slow',function(){});
		return false;
	});
	$(document).on('click','.attachcomment a[name="show"]',function(){
		$(this).parents('.attachcomment').fadeOut('slow',function(){});
		var layout = $(this).parents('.widget-column');
		var container = $(this).parents('.widget-column').children('div').children('.widget');
		if(container.hasClass('quizbac')){
			var comments = $(this).parents('.widget-column').find('.hiddenquiz');
			$('.hiddenquiz').css({"display":""})
		}else{
			var comments = $(this).parents('.widget-column').find('.hiddenclass');
		}
		layout.append(comments.html());
		return false;
	});

	$(document).on('change','.quizoption li',function(){
		var userOption = $(this).attr('data-option');
		$(document).on('click','#submit-quiz',function(){
			var answer = $('.answercontainer h5').attr('title');
			if(userOption == answer){
				answerbox = '<h5>You chose the correct answer!</h5>';
			}else{
				answerbox = '<h5>You chose the wrong answer</h5><h5>The right answer is: '+answer+'</h5>';
			}
			$('#wrapquiz').empty();
			$('#wrapquiz').append(answerbox);
			return false;
		});
	});

	$(document).on('click','#take-quiz',function(){
		var wrapper = $(this).parents('.greenish').find('.addhtwo');
		var question = $(this).parents('.greenish').find('.questioncontainer');
		// Timer
		var minutes = $('.timer').attr('data-time');
		var seconds = minutes * 60;
		var countdown = setInterval(function() {
		    var current = convertIntToTime(seconds);
		    $('.timer').html(current);
		    if(seconds == 0) { 
		        clearInterval(countdown);
		        $('#wrapquiz').empty();
		        $('#wrapquiz').append('<h5>Time Elapsed!!!</h5>');
		    }
		    seconds--;
		}, 1000);
		wrapper.empty();
		wrapper.append(question.html());
		return false;
	});
	$(document).on('click','#stop-quiz',function(){
		$('#wrapquiz').empty();
		$('#wrapquiz').append('<h5>Quiz stopped by you!</h5>');
		return false;
	});
	$(document).on('change','#answer',function(){
		var value = $(this).val();
		if(value == 'off'){$(this).val($(this).attr('data-option'));}else{$(this).val('off');}
	});
	if($('[role="dropzone"]').get(0) !==  undefined){

		drop = new Dropzone('.add-file', {url: "http://localhost/testdropzone/index.php/test/upload_img/",maxFiles:3,uploadMultiple:false,
		addRemoveLinks:true,autoProcessQueue:false, init: function(){

			this.on("addedfile", function(file){ 

				var cap = parseInt($('.add-file').attr('data-template-cap'));

				if($('.set-file').children('div').length <= cap){
					var attachment = $('section.set-file').children('div:last').clone();
					attachment.removeClass('template');
					attachment.children('p').text(file.name);
					$('section.set-file').children('div:last').before(attachment);
				} else{
					alert("Limit Exceeded!");
				}
			});
		}});
	}
	$(document).on('keypress','.groupchatbox',function(e){
		if(e.keyCode == 13){
			var element = $(this);
			var form = $(this).parents('form');
			var data = form.serialize();
			var gList = $(this).attr('data-group-list');

			$.ajax({url:form.attr('action'),data:data,method:'POST',
				success:function(response){
					element.val('');
					reloadSection($('.gist-list'));								
				},
				error:function(response,error,xhr){
					console.log('error');
				}
			});
		}
	});

	$(document).on('click','a[data-reveal-id="editPost"]',function(){
		var postId = $(this).attr('data-post-id');
		window.location.href = base +'courses/view/4?id=' + postId;
		// $('#editPost>input[type="hidden"]').val(postId);
	});

$(document).on('click','.remove-file',function(){
	
	var idx = $(this).parents('div').index();
	
	console.log(idx);
	var filesArr = drop.getQueuedFiles();
	drop.removeFile(filesArr[idx]);

	$(this).parents('div:first').remove();
});

$("section.set-file").on("click", "div", function() {
    console.log( $(this).index() );
});

$(document).on('click','.upload-photo',function(){
	drop.processQueue();
});

	/**Initialize Pluggins**/
	$(document).foundation();
	setNotificationMessageNumbers();
	messageNotificationCountRefresh();
	messageRefresh();

	// Sending Course Outline checkbox values to DB

	$(document).on('change','input[name="done-outline"]', function(){
		var outlineId = $(this).parents('li').attr('data-id');
		var outlineValue = $(this).val();
		if (outlineValue == 1) {
			outlineValue = 0;
			$.post(base + '/courses/done_outline/' + outlineValue + '/' + outlineId, function(data) {});
		}else{
			outlineValue = 1;
			$.post(base + '/courses/done_outline/' + outlineValue + '/' + outlineId, function(data) {});
		}

	});

		/**Initialize Pluggins**/
	$(document).foundation();
	setNotificationMessageNumbers();
	messageNotificationCountRefresh();
	messageRefresh();

	/**initialize dropzone for picture uploads**/
	$('.form-photo').each(function(){

		url = $(this).attr('data-url');
		var prevCont = $(this).parents('div:eq(1)').children('div:first').children('.passport');
		$(this).dropzone(  { 	
								url: url,
								maxFiles:1,uploadMultiple:false,addRemoveLinks:false,
								autoProcessQueue:false,
								previewsContainer: '.passport',//just let this point to a valid element that it cant place the thumbnail in
								
								init:function(){
									this.on('thumbnail',function(file,url){prevCont.find('img').attr('src',url)});
								},
								accept:function(file,done){

									//make sure only images are uploaded
									if(!file.type.match(/image.*/)){
										alert('Only Image uploads are allowed');
										this.removeFile(file);
									}
								}
							});	
	});

	/**Dynamic Page building For Walkthrough**/
	$(document).on('click','.get-level-grade-list,.get-level-arm-list',function(){

		var ID = $(this).attr('data-tab-id');
		var classList = $('[name="level-choice"]:checked').parents('.tbl-row').find('.level-list').html().split(',');
		var gradeList = [];
		$('.grade-standard-choice:checked').each(function(){

			var newVal = $(this).parents('.tbl-row').find('.grade-standard').html();
			gradeList.push(newVal);
		});
		
		//flush the non template list elements
		$('#'+ID+' ul li:not(:first)').remove();

		//assign different panel names for step 7 and 8
		var panelOption = ($(this).hasClass('get-level-grade-list'))? 'panel-level-grade-' : 'panel-level-arm-';
		for(var id in classList){

			var clone = $('#'+ID+' li.temp').clone();
			clone.find('.class-desc').html(classList[id]);

			//loop over the different grades
			for(var gradeID in gradeList){

				var gradeClone = clone.find('.panel-size > .temp').clone();

				gradeClone.children('.grade-level-choice').html(gradeList[gradeID])
				gradeClone.removeClass('temp');

				clone.find('.panel-size').append(gradeClone);
			}

			//increment panel related controls
			clone.find('[data-toggle-panel ^="panel"]').attr('data-toggle-panel',panelOption+id);
			clone.find('[id ^="panel"]').attr('id',panelOption+id);

			//new row should be made visible
			clone.removeClass('temp');
			clone.find('input[type="radio"]').attr('checked',true);
			$('#'+ID+' ul').append(clone);
			$('#'+ID+' ul li:eq(1) > .panel-size').show();
		}
	});	

	/**Simer Custom Pluggins**/
	$(document).on('click','.slider,.base-container',function(){
		if($('.yield-box').hasClass('visible'))
		{
			$('.yield-box').removeClass('visible');
			$('.yield-box').slideUp();
			$('#quickie-icons').children().removeClass('active');
		}		
	});

	//Duplicate Widget Columns and Their Children
	$(document).on('click','[role="data-widget-multiplier"]',function(){
		
		var target = $(this).attr('data-target'); // specify container from which to perform duplication
		var lastCol = $('#'+target+' div[role="col-to-duplicate"]:last');
		var thresh = lastCol.attr('data-threshold');

		var children = lastCol.children();
		var childrenLen = children.length
		var lastChild = children[childrenLen-1];

		if(childrenLen < parseInt(thresh)){

			newChild = $(lastChild).clone();//duplicate last child				
			$(lastChild).after(newChild);				

		}else{

			lastColClone = lastCol.clone();
			var lasChildIndex = thresh-1;

			/**update the clone with relevant info
			*i.  Find elements with data attribute data-to-change = "true"
			*ii. Update Clone,;m
			*/
			lastColClone.children(':not(:eq('+lasChildIndex+'))').remove();//leave only last element in new column
			lastCol.after(lastColClone);
		}

		return false;
	});

	//Sweet progress bar slide
	$('[role="progressbar"]').each(function(){
			
		var width = $(this).attr('data-width');
		$(this).animate({width:width},1500);
	});		

	//open target tab in modal
	$(document).on('click','[role="target-tab"]',function(){

		var target = $(this).attr('data-target-tab');
		var modal = $(this).attr('data-reveal-id');

		//make tab active
		$('#'+modal).find('[data-tab-id="'+target+'"]').parents('li').addClass('active').siblings().removeClass('active');

		//make tab content active		
		$('#'+modal).find('#'+target).addClass('active').show().siblings().removeClass('active').hide();
	});

	//Simer simple OR-Tab Functionality		
	$(document).on('click','.tab',function(){

		/**
		*i.	 	Make the clicked tab the active one
		*ii.	Get the associated container for all the different tabs
		*iii.	Get the container to be made active from clicking the corresponding tab
		*iv. 	Bring the tab content to view and hide siblings
		*/

		//make current selection active
		$(this).parents('li').siblings().removeClass('active');
		$(this).parents('li').addClass('active')

		//change to active tab content
		var tabContent = $(this).parents('.tabs').attr('data-tab-content');
		var activeTabContent = $(this).attr('data-tab-id');
					

		if($(this).attr('role') == 'tab-per-element'){		

			if(activeTabContent !== 'all'){
				$('#'+tabContent).children('[role="'+activeTabContent+'"]').fadeIn().siblings().hide();		
			}else{
				$('#'+tabContent).children().fadeIn();
			}							

		}else{

			if(activeTabContent !== 'all'){
				$('#'+tabContent).children('#'+activeTabContent).show().addClass('active').siblings().removeClass('active').hide();		
			}else{
				$('#'+tabContent).children().show();
			}
		}
		return false;
	});		
	

	/**Yet another continue and back for side tabs, TODO: Merge all these to one, FAST!!!.**/
	$(document).on('click','.next',function(){

		//start tab if non is selected in the first place
		if($(this).parents('.tab-content').siblings('.columns').children('li.active') == undefined){

			//start tabs on the left
			$(this).parents('.tab-content').siblings('.columns').children('li:first').addClass('active');
		}else{

			//continue tabs on the left
			$(this).parents('.tab-area').find('li.active').next().addClass('active').siblings().removeClass('active');			
		}

		//advance the tab content
		$(this).parents('.tab-content').children('div.active:first').next().show().addClass('active').siblings().removeClass('active').hide();
	});

	$(document).on('click','.previous',function(){

		//continue tabs on the left
		$(this).parents('.tab-area').find('li.active').prev().addClass('active').siblings().removeClass('active');			
		
		//advance the tab content
		$(this).parents('.tab-content').children('div.active:first').prev().show().addClass('active').siblings().removeClass('active').hide();
	});

	/**Continue and back functionality for lightbox independent options**/
	$(document).on('click','button.continue',function(){

		/**
		*i.Get the tab to control
		*ii.set the next tab to active
		*iii.Go through the coresponding tab-content area
		*On to the next one
		*/
		var tab = $(this).attr('data-tab-control');
		$('[data-tab-content="'+tab+'"] li.active').next().next().addClass('active').siblings().removeClass('active');			
		
		$('#'+tab).children('.active').next().addClass('active').siblings().removeClass('active');

		return false;
	});

	$(document).on('click','button.back',function(){

		/**
		*i.Get the tab to control
		*ii.Set the Prev tab to active
		*iii.Go through the coresponding tab-content area
		*On to the previous one
		*/

		var tab = $(this).attr('data-tab-control');
		$('[data-tab-content="'+tab+'"] li.active').prev().prev().addClass('active').siblings().removeClass('active');			
		
		$('#'+tab).children('.active').prev().addClass('active').siblings().removeClass('active');

		return false;
	});
	/**End Continue functionality for lightbox**/

	//Ajax form Post

	//Row Duplication		
	$(document).on('click','.add-more,.add-more-table', function(){

		var elemCount,new_row,lastElem;
		var context = $(this).attr('data-context');

		//TODO: Define a parent context instead of doing this crap
		if($(this).hasClass('add-more')){

			elemCount = $(this).parents('.'+context).children('.row-temp').length;
			lastElem = $(this).parents('.'+context).children('.row-temp:last'); 		

			//in case the the target is deeper than a direct child level, just go one more level deeper
			lastElem = (lastElem.get(0) !== undefined)?lastElem:$(this).parents('.'+context).children().children('.row-temp:last');

			new_row = lastElem.clone();

		}else{

			elemCount = $(this).parents('.tbl:first').children().length;
			lastElem = $(this).parents('.tbl:first').children('.row-temp:last');
			new_row = lastElem.clone();
		}		
				
		//uncheck any checked item
		new_row.find('input:checked').attr('checked',false);

		//increment anything that needs incrementing
		new_row.find('.increment').html(parseInt(new_row.find('.increment').html())+1);

		//blank all text fields
		new_row.find('input[type="text"]').val('');
		new_row.find('input').attr('placeholder','');

		//update any panel element to have unique id attribute
		oldRowID = new_row.find('[id^="panel"]').attr('id')
		new_row.find('[id^="panel"]').attr('id',oldRowID+elemCount+1);
		new_row.find('[data-toggle-panel^="panel"]').attr('data-toggle-panel',oldRowID+elemCount+1);			

		var old_val = new_row.find('input[type = "radio"]').val();
		new_row.find('input[type =  "radio"]').val(++old_val);		
		new_row.addClass('go-parent');		

		if($('#quiz').get(0) != undefined){//is quiz question
			$(this).parents('div').prev('section').children(':last').before(new_row);				
		}else{
			lastElem.after(new_row);

			//if has panel, make the panel visible if hidden
			var panel = $(this).parents('.'+context).children('.row-temp:last').find('[id^="panel"]');			
			if(panel.not(':visible')){
				panel.slideToggle();
			}
		}

		return false;
	});

	//Simer Accordion
	$(document).on('click','a[data-toggle-panel^="panel"]',function(){

		var panel = $(this).attr('data-toggle-panel');			
		$('#'+panel).slideToggle();
		return false;
	});

	//hijax button		
	$(document).on('click','.hijax-button',function(){

		var href = $(this).attr('href');
		$.get(href);

		delete_stuff($(this).parents('.preview'));
		return false;
	});

	
	//generic controller/controller element toggle functionality
	$(document).on('click','.toggleVisible',function(){

		var ElemId = $(this).attr('data-hide-id');
		var Elem = $('#'+ElemId);

		if(Elem.is(':visible')){
			Elem.hide();

		}else{
			Elem.show();
		}
	});

	/**Simer Custom Pluggins**/

	$(".classedit a").tooltip({placement : 'bottom'});

	if($('.donut').get(0) != undefined){
		//Chart js 
		var doughnutData = [
					{
						value : 33,
						color : "#67CBB7"
					},
					{
						value: 67,
						color:"#F7b35B"
					}		
				
				];

		var myDoughnut = new Chart(document.getElementById("canvasgso").getContext("2d")).Doughnut(doughnutData, {percentageInnerCutout:85});

		var doughnutstData = [
					{
						value : 13,
						color : "#67CBB7"
					},
					{
						value: 31,
						color:"#F7b35B"
					},
					{
						value: 33,
						color:"#F7b35B"
					}		];			
				

		var myDoughnutst = new Chart(document.getElementById("canvasgst").getContext("2d")).Doughnut(doughnutstData, {percentageInnerCutout:90});

		var doughnutsData = [
					{
						value : 53,
						color : "#69D1E7"
					},
					{
						value: 47,
						color:"#CC7B98"
					}
				];

		var myDoughnuts = new Chart(document.getElementById("canvasgs").getContext("2d")).Doughnut(doughnutsData, {percentageInnerCutout:90});
		
		var doughnutaData = [
					{
						value : 17.5,
						color : "#89B95B"
					},
					{
						value: 25.2,
						color:"#CC7B98"
					},
					{
						value : 11.6,
						color : "#A385C5"
					},
					{
						value: 18,
						color:"#69D1E7"
					},
					{
						value : 34.9,
						color : "#4CBA9D"
					},
					{
						value: 9,
						color:"#07AFB1"
					},
					{
						value : 5.8,
						color : "#F18731"
					},
					{
						value: 14.8,
						color:"#ED4747"
					}
				];

		var myDoughnuta = new Chart(document.getElementById("canvasa").getContext("2d")).Doughnut(doughnutaData, {percentageInnerCutout:90});
	
		var barChartData = {
			labels : ["January","February","March","April","May","June","July"],
			datasets : [
				{
					fillColor : "rgba(220,220,220,0.5)",
					strokeColor : "rgba(220,220,220,1)",
					data : [65,59,90,81,56,55,40]
				},
				{
					fillColor : "rgba(151,187,205,0.5)",
					strokeColor : "rgba(151,187,205,1)",
					data : [28,48,40,19,96,27,100]
				}
			]
			
		}

	var myLinebar = new Chart(document.getElementById("canvasbar").getContext("2d")).Bar(barChartData);
	}
	if( $('.scroll-area').get(0) != undefined)
	{		
		$('.scroll-area').jScrollPane();
	}

	if( $('.bx-slider,.bx-slider-welcome,.notification-slide').get(0) != undefined)
	{	
		$('.bx-slider-welcome').bxSlider({controls:false,auto:true,mode:"vertical",pause:.1,speed:500,pager:false,autoHover:true});			
		$('.bx-slider').bxSlider({controls:false,auto:true,mode:"vertical",pause:.5,speed:5000,pager:false,autoHover:true});		
		$('.notification-slide').bxSlider({controls:false,auto:true,mode:"horizontal",pause:.5,speed:2000,pager:false,autoHover:true});
	}

	if($(".auto-text").get(0) != undefined){

		/**Auto Suggest User Names -- Messages**/
		$(".auto-text").tokenInput($('base').attr('href')+'users/get_users',{theme:'facebook',tokenLimit:1});
	}

	if($(".auto-interests").get(0) != undefined){

		/**Auto Suggest Interests**/
		$(".auto-interests").tokenInput($('base').attr('href')+'interests',{theme:'facebook',tokenLimit:1});
	}

	//datepicker
	if($(".input-group.date").get(0) != undefined){

		$(".input-group.date").datepicker({ autoclose: true, todayHighlight: true });
	}

	//initialize message convo
	loadPreview($('.preview.selected'));

	//shift-enter for textareas
	if($('.instant-text').get(0) != undefined){
		$('.instant-text').shiftenter();
	}
	/**End Initialize Pluggins**/
	
	$(document).on('click','.profile-interests span:last-child',function(){

		var id = $(this).attr('data-id');

		$(this).parents('li').fadeOut('slow',function(){
			$(this).remove();			
		});

		$('input[value="'+id+'"]').remove();
	});

	$(document).on('click','.hijax-post',function(){

		var parent = $(this).parents('.reveal-modal');
		var parentH1 = $(this).parents('.reveal-modal').children('h1');
		$(this).parents('.reveal-modal').append('<div class="status-text"><p>Loading...</p></div>').children('.status-text').slideToggle();

		/**handle for different scenarios**/
		var url = $(this).parents('form').attr('action');
		$.post(url, function(data){			
				
				//display message to user
				data = JSON.parse(data);			
				console.log(data);

				if(data.error){

					parent.children('.alert').remove();
					parent.children('.status-text').slideUp();
					parentH1.after(data.msg);	

				}else{
					//upload photo
										
				}
			}
		);				

		return false;
	});
	
	//block a user
	$(document).on('click','.block-user,.delete-thread',function(){

		//if deleted message was the one selected
		if($(this).parents('.preview').hasClass('selected')){

			//go to the next message if available
			if($(this).parents('.preview').next().get(0) != undefined){

				$(this).parents('.preview').next().addClass('selected');
				loadPreview($(this).parents('.preview').next());
			
			//if not try previous if there is a previous
			}else if($(this).parents('.preview').prev().get(0) != undefined){

				$(this).parents('.preview').prev().addClass('selected');
				loadPreview($(this).parents('.preview').prev());
			}
		}		

		$('.converse-container .scroll-area').children().fadeOut();

		//if its the blocked user class that was clicked
		if($(this).hasClass('block-user')){

			var base = $('base').attr('href');
			var name = $(this).parents('.text').children('h1').text();
			var src = $('.passport').children('img').attr('src');
			var id = $(this).attr('data-block-id');

			var temp = $('.blocked-user.temp').clone();
			temp.find('h1').html(name);
			temp.find('img').attr('src',src);
			temp.find('.unblock').attr('href',base+'messages/unblock_user/'+id);
			temp.removeClass('temp');

			//append to blocked list
			$('#blocked-list').append(temp);

			$('.block h1').html(parseInt($('.block h1').html()) + 1 );
		}

		delete_stuff($(this).parents('.preview'));
		$.get($(this).attr('href'),function(){setNotificationMessageNumbers()});

		return false;
	});
	
	//Unblock a user
	$(document).on('click','.unblock',function(){
		delete_stuff($(this).parents('.blocked-user'));
		$.get($(this).attr('href'));

		$('.block h1').html(parseInt($('.block h1').html()) - 1);
		return false;
	});

	//handle adding new group
	$(document).on('click','.show-group',function(){

		var url = $(this).attr('href');
		$.ajax({url:url,dataType:'html',

			success:function(data){

				$('.group-widget-container').children('.widget-column:first').after(data);
				//console.log('html: '+data);
			},

			error:function(xhr,error){
				console.log(error);
			}
		});

		return false;
	});

	/**Generic Functionality**/

	//handle all tags
	$(document).on('change','.addtag',function(){

		var dropdown = $(this);
		var id = $(this).val();
		var form = $(this).parents('form');

		$(this).children('option').each(function(){
			if($(this).attr('value') == id){
				
				dropdown.parents('.sub-row:first').siblings('.profile-interests').children('ul').append('<li><span>'+ $(this).html() +'</span><span data-id='+id+'>&#215;</span></li>');
				form.append('<input type="hidden" name=tags[] value="'+id+'"/>');
			}
		});		
	});	

	// Change File Input
	$(document).on('change','input[name="file"]',function(event){
		$('.fileContainer span').text($(this).val());
		files = event.target.files;

		for (var i = 0; file = files[i]; i++) {
		    console.log(file);
		}		
	});

	
	// Handle Delete Elements Which Have Links To Follow
	$(document).on('click','.smart-go',function(){
		var del = $(this);
		var element = del.parents('.go-parent:first');

		removeElement(element,del.attr('href'));
		return false;
	});

	// Handle Delete Elements Which "DONT" Have Links To Follow
	$(document).on('click','.unsmart-go',function(){
		var del = $(this);
		var element = del.parents('.go-parent:first');

		if(element.index() !== 0){ //dont delete if its the first element in its list
			delete_stuff(element); 
		}			
			
		return false;
	});

	//Elemnt Mirror Fxnality
	$(document).on('keyup','.text-mirror',function(){

		/*let mirror affect only sibling or "almost sibling" elements
		and not other unintended elements, get mirror context which is 
		the first common parent they(mirrore and mirroee :D) share*/
		var context  = $(this).attr('data-mirror-context');
		var parent = $(this).parents('.'+context+':first');
		parent.find('.'+$(this).attr('data-mirror')).html($(this).val());
		
	});

	//Element Compound Mirror Fxnality
	$(document).on('keyup','.text-compound-mirror input',function(){
		
		var compoundVal= "";
		var className = $(this).attr('class');

		//get all siblings
		$('.'+className).each(function(index,elem){
			
			compoundVal += $(elem).val();
			if($('.concat').length-1 !== index)compoundVal += ',';
		});			
		
		var context  = $(this).parents('.text-compound-mirror').attr('data-mirror-context');
		var parent = $(this).parents('.'+context+':first');
		parent.find('.'+$(this).parents('.text-compound-mirror').attr('data-mirror')).html(compoundVal);
		
	});
	/**End Generic Functionality**/

	
	// Change File Input
	$(document).on('change','input[name="file"]',function(event){
		$('.fileContainer span').text($(this).val());
		files = event.target.files;

		for (var i = 0; file = files[i]; i++) {
		    console.log(file);
		}		
	});

	//handle adding new group
	$(document).on('click','.show-group',function(){

		var url = $(this).attr('href');
		$.ajax({url:url,dataType:'html',

			success:function(data){

				$('.group-widget-container').children('.widget-column:first').after(data);
				//console.log('html: '+data);
			},

			error:function(xhr,error){
				console.log(error);
			}
		});

		return false;
	});

	//instant posting from text area
	$(document).on('keydown','.instant-post',function(e){

		if(e.keyCode == 13){//if enter is pressed
			
			var element = $(this);
			var form = $(this).parents('form');
			var data = form.serialize();

			$.ajax({url:form.attr('action'),data:data,method:'POST',
				success:function(response){
					element.val('');
					loadPreview($('.preview.selected'));								
				},
				error:function(response,error,xhr){
					alert('error');
				}
			});
		}			
	});
	
	$(document).on('keyup','.text-mirror',function(){

		$('.'+$(this).attr('data-mirror')).html($(this).val());
		
	});

	$('a[href^="#panel"]').click(function(){

		$(this).parents('.tbl-row').siblings('.content').toggleClass('active');
		return false;
	});
	
	/**Add Question for the Quiz**/
	$(document).on('click','button.add-question',function(){
		var new_question = $(this).parents('.quizlist > li:last').clone();				
		$(this).parents('.quizlist').children('li:last').after(new_question);

		$(this).parents('.quizlist').children('li:last').find('input[type="checkbox"]').attr('checked',false);
		$(this).parents('.quizlist').children('li:last').find('input[type="text"]').val('');

		$(this).remove();
		return false;
	});
	/**End Add Question for the Quiz**/

	/**Delete Quiz Question**/
	$(document).on('click','.delete-question',function(){

		if($('.quizlist > li').length > 1)
		{
			//just in case the question deleted had the last add question button
			var add_question = $('button.add-question');
			$(this).parents('li:first').prev().find('button.add-option').after(add_question);
			delete_stuff($(this).parents('li:first'));			
		}

		return false;
	});
	/**End Delete Quiz Question**/

	/**Add Option for the Quiz**/
	$(document).on('click','button.add-option',function(){
		var new_option = $(this).siblings('.clearfix:last').clone();				
		$(this).before(new_option);

		$(this).siblings('.clearfix:last').find('input[type="checkbox"]').attr('checked',false);
		$(this).siblings('.clearfix:last').find('input[type="text"]').val('');

		return false;
	});
	/**End Add Option for the Quiz**/

	/**Delete Quiz Option**/
	$(document).on('click','.delete-option',function(){

		delete_stuff($(this).parents('li.clearfix:first'));
		return false;
	});
	/**End Delete Quiz Option**/

	/**Toggle use timer for quiz**/
	$(document).on('click','#use-timer',function(){

		if($(this).is(':checked')){
			$(this).parents('p:first').siblings('input[type="number"]').attr('disabled',false);
		}else{
			$(this).parents('p:first').siblings('input[type="number"]').attr('disabled',true);
		}
	});

	/**End Toggle use timer for quiz**/

	/**Options Toggle for creating posts**/

	$(document).on('click','input[name="post_type"]',function(){

		//activate appropriate section		
		$('.dependent-options #'+$(this).attr('data-option')).addClass('active').siblings().removeClass('active');		
	});

	/**End Options Toggle for creating posts**/

	// Twitter-like countdown for text-area
	var left = 200
    $('#text_counter').text(' ' + left);

        $('#status').keyup(function () {

        left = 200 - $(this).val().length;

        if(left < 0){
            $('#text_counter').addClass("overlimit");
        }
        if(left >= 0){
            $('#text_counter').removeClass("overlimit");
        }

        $('#text_counter').text(' ' + left);
    });
    // End of twitter-like count-down
	
	$(document).on('click','.remove-default',function(){
		//$('#LargeModal').foundation('reveal','open');
		return false;		
	});

	// Handle Delete Widget Events
	$(document).on('click','.delete-widget',function(){

		var del = $(this);
		del.parents('.widget-column:first').fadeOut('slow');

		$.ajax({

			url:del.attr('href'),
			dataType:'html',
			success: function(data){
				
			},
			error:function(xhr, data, error){
				alert('Ajax Error: '+ error);
			}
		});

		return false;
	});

	//Ajax Page load
	$(document).on('click', '.sl', function() {
		loading('show');
		var $href = $(this).attr('href');
		$(".base-container").animate({
			'opacity': '0'
		}, 500, function() {
			$(".base-container").load($href, function() {
				$(".base-container").animate({
					'opacity': '1.0'
				}, 500, function() {
					loading('hide');

					if($href.indexOf('messages/home') != -1){//if on message page
						
						//initialize message convo
						loadPreview($('.preview.selected'));
					}
				});
			});
		});
		return false;
	});

	//Load message thread
	$(document).on('click', '.preview', function() {

		//show converse container column if hidden
		if($('.converse-container-col').not(':visible')){
			$('.converse-container-col').show();
		}

		//make clicked item selected
		$(this).siblings().removeClass('selected');
		$(this).addClass('selected').addClass('read');

		//update unread count	
		var unread = parseInt($('#pointer-area').children('.preview').length) - parseInt($('#pointer-area').children('.read').length);
		$('.unread').html(unread);

		//actually load message thread here
		loadPreview($(this));
	});

	/* Search */
	$(document).on('keyup', '#search input', function() {
		if($(this).val().length>2){
			$('#SearchModal').foundation('reveal','open');
			$('#typing').html($(this).val());
			setSearchResults($(this).val());
       	}
       	return false;
	});

	/**Hide Notifications Dropdown On DOM Load**/
	var notif_height = $('.yield-box').height();
	var go_to = -1 * notif_height-70;

	setNotificationMessageNumbers();
	
	/* View notifications */
	$(document).on('click','#quickie-notifications, #quickie-msg, #profile-group', function() {

		if($('.yield-box').not(':visible')){$('.yield-box').show();}

		var id = $(this).attr('id');
		if($(this).hasClass('active')) {

			$('.yield-box').animate({
				'top': go_to
			}, 300);			
			$(this).removeClass('active')
			$('.yield-box').removeClass('visible');
			$('.yield-box').hide();

		}else {	//Load Elements Pertinent to Category
			$(this).siblings().removeClass('active');
			$(this).addClass('active');

			var base = $('base').attr('href');
			
			switch(id){
				case 'quickie-msg':
					$('#bar-messages .scroller').html('<p>Loading...</p>');

					//Load Messages					
					$.ajax({
					  type: 'POST',
					  url: 'users/get_unseen_messages',
					  dataType:"json",  
					  success: function(data) {
						  $('#bar-messages .scroller').empty();
						  
						  if (data.length > 0) {
							for (var k = 0; k < data.length; k++) { 
								$('#bar-messages .scroller').append('<div class="bell-box"><a href="message/view/"'+data[k].id+'>'+data[k].message+'</a></div>');
							}
						  }else{						  	
							$('#bar-messages .scroller').append('<div class="bell-box">No New Messages</div>');
						  }
						  setNotificationMessageNumbers();
					  },
					  error: function(){
						alert("Error Fetching Messages");
					  }
					});

					$('#bar-messages').show();
					$('#bar-notifications').hide();
					$('#bar-profile-pic').hide();
					break;
				case 'quickie-notifications':
					
					$('#bar-notifications .scroller').html('<p>Loading...</p>');

					//Load Notifications
					$.ajax({
					  type: 'POST',
					  url: 'users/get_notifications',
					  dataType:"json", 
					  success: function(data) {

						    $('#bar-notifications .scroller').empty();

						    if(data != null && data != '') {
						  	
						  		for (var k = 0; k < data.length; k++) { 
									$('#bar-notifications .scroller').append('<div class="bell-box">'+data[k].type_id+'</div>');
								}

						  	}else{						  	
								$('#bar-notifications .scroller').append('<div class="bell-box">No New Notifications</div>');
						  	}						  
						  
						  	setNotificationMessageNumbers();
					  },
					  error: function(){
						alert("Error Fetching Notifications");
					  }
					});

					$('#bar-notifications').show();
					$('#bar-messages').hide();
					$('#bar-profile-pic').hide();
					break;
				case 'profile-group':
				
					//Show options 
					$('#bar-profile-pic').show();
					$('#bar-messages').hide();
					$('#bar-notifications').hide();									
					break;
			}
			
			$('.yield-box').animate({
				'top': 0
			}, 300);
			$('.yield-box').addClass('visible');
		}

		return false;
	});

	/**Implicit load**/
	$(document).on('click', '.sl', function() {
		loading('show');
		var $href = $(this).attr('href'); 
		history.pushState({}, "", $href);//update the browser url

		//check if user is still logged in
		var logged_in ,url = $('base').attr('href')+'welcome/is_logged_in';

		$.getJSON(url,function(data){
			logged_in = data;		

			if(!logged_in.is_true)
			{					
				$('#tinyModal p').html('You need to login first. <a href="'+$('base').attr('href')+'login">Login Here.</a>');
				$('#tinyModal').foundation('reveal','open');
				loading('hide');

				return false;
			}else if(logged_in.is_true)
			{
				$(".base-container").animate({
					'opacity': '0'
				}, 500, function(){

					//start message refresh if user is on message page
					messageRefresh();				

					$(".base-container").load($href, function() {

						$(this).find('.scroll-area').jScrollPane();
						$(document).foundation('reflow');
						
						/**Re-Initialize after ajax load - Auto Suggest**/
						$(".auto-text").tokenInput($('base').attr('href')+'users/get_users',{theme:'facebook',tokenLimit:1});
						$('ul.token-input-list-facebook:eq(1)').hide();									
						
						$(".base-container").animate({
							'opacity': '1.0'
						}, 500, function() {
								loading('hide');
							});
					});
				});
			}		
		});					
		return false;
	});

});
function loading(action) {
	if(action == 'show') {
		$('#loading-icon').animate({ 'top':'0' }, 300);
	}
	if(action == 'hide') {
		$('#loading-icon').animate({ 'top':'-50' }, 300);
	}
}

/**
*Fade and remove stuff from DOM
**/
function delete_stuff(stuff)
{
	stuff.fadeOut('slow',function(){
		stuff.remove();	
	});	
}

function setNotificationMessageNumbers()
{	
	if($('#quickie-notifications').get(0) !== undefined){ //only run when the user is actively runing the app

		//Set Notification and Message Numbers
		$.getJSON('users/get_unseen_message_count',
			function(data) {		  	
				$('#quickie-msg span').html(''+data.count);	

				(parseInt(data.count) == 0)	 ? $('#quickie-msg span').hide() : "";
	  	});

		$.getJSON('users/get_notification_count',
			function(data) {		  	
				$('#quickie-notifications span').html(''+data.count);		
				(parseInt(data.count) == 0)	 ? $('#quickie-notifications span').hide() : "";  	
	  	});
	}
}

/**
*Load message thread for selected message pointer
*/
function loadPreview(clicked) {

	if(clicked.get(0) != undefined){
		$.ajax({
			url:clicked.attr('data-url'),
			dataType:'html',
			success: function(data){
				//handle selected message 
				if(!clicked.hasClass('selected'))
				{
					clicked.siblings('.selected').removeClass('selected');
					clicked.addClass('selected');					
				}
                $('.msg-user-name h1').html(clicked.children(".text").children("h1").html());
				$('.converse-container .scroll-area').html(data);
				$('.converse-container .scroll-area').jScrollPane();
				$('.converse-container .scroll-area').animate(
					{
						scrollTop:$('#message-scroll').get(0).scrollHeight
					}
					, 'slow');
	

				$('.scroll-area').css({overflow:"auto"});
			},
			error:function(xhr, data, error){
				alert('Ajax Load Message Error');
			}
		});
	}
}

function reloadSection(clicked){
	if(clicked.get(0) != undefined){
		$.ajax({
			url:clicked.attr('data-url'),
			dataType:'html',
			success: function(data){
				console.log(data);
				$('.addhthree .scroll-area').html(data);
				$('.addhthree .scroll-area').jScrollPane();
				$('.addhthree .scroll-area').animate(
					{
						scrollTop:$('#gist-scroll').get(0).scrollHeight
					}
					, 'slow');
	

				$('.scroll-area').css({overflow:"auto"});
			},
			error:function(xhr, data, error){
				alert('Ajax Load Message Error');
			}
		});
	}
}

/**
*Keep Checking For new messages
*/
function messageRefresh()
{		
	if($('.converse-container').get(0) != undefined){ //if on message page
		
		msgInterval = setInterval(function(){
												var currentMessageThread = $('.preview.selected');
												loadPreview(currentMessageThread)
											},10000);//refresh every 10 seconds

	}else if($('.converse-container').get(0) == undefined){
		
		//clear interval if it was started and the user left that page
		clearInterval(msgInterval);
	}
}

/**
*Message and Notification Count Refresh
*/
function messageNotificationCountRefresh()
{
	if($('#quickie-notifications').get(0) !== undefined){ //only run when the user is actively runing the app
		msgNotificationCount = setInterval(function(){setNotificationMessageNumbers()},10000);//refresh every 10 seconds
	}
}

function setSearchResults(criterion)
{
	$('.results ul').empty();
	$('.results ul').text('Loading...');
	//Set Search Results
	$.ajax({
		type: 'POST',
	    url: 'users/get_users',
	  	dataType:"json",  
	  	success: function(data) {
	  		$('.results ul').empty();
		  	if (data != null) {
				for (var k = 0; k < data.length; k++) { 
					$('.results ul').append('<li>'+data[k].name+'</li>');
				}
		  	} else{
		  		$('.results ul').append('<li>No Results</li>');
		  	}
	  	},
	  	error: function(){
			alert("Search Error.");
	  	}
	});
}

function duplicateRow(row){
	var new_row = row.parents('div').prev('section').children('div:last').clone();
	var old_val = new_row.find('input[type =  "radio"]').val();
	new_row.find('input[type =  "radio"]').val(++old_val);
	new_row.removeClass('template');
	row.parents('div').prev('section').children('div:last').before(new_row);
}


/*Table Report Mouseover*/
$(function(){
	$('.table-report td').mouseover(function () {

		//Get table row index
		var rIdx = $(this).parents('tr').index();
		//Select all table rows
		$('.table-report tr:nth-child(' + (rIdx + 1) + ')').children('td').removeClass('mouseout').addClass('mouseover').not('.mouseclick');
	    
	    //Get table column index
	    var cIdx = $(this).index();
	    //Select that table's columns
	    $(this).parents('tr').siblings().children('td:nth-child(' + (cIdx + 1) + ')').removeClass('mouseout').addClass('mouseover').not('.mouseclick');
	});
	$('.table-report td').mouseleave(function () {

		var rIdx = $(this).parents('tr').index();
		$('.table-report tr:nth-child(' + (rIdx + 1) + ')').children('td').removeClass('mouseover').addClass('mouseout').not('.mouseclick');
	    
	    var cIdx = $(this).index();
	    $(this).parents('tr').siblings().children('td:nth-child(' + (cIdx + 1) + ')').removeClass('mouseover').addClass('mouseout').not('.mouseclick');
	});
	$('.table-report td').click(function () {
		
		var rIdx = $(this).parents('tr').index();

		if($('.table-report tr:nth-child(' + (rIdx + 1) + ')').children('td').hasClass('mouseclick')){
			//If "clicked" is already highlighted, 
			$('.table-report tr:nth-child(' + (rIdx + 1) + ')').children('td').removeClass('mouseclick');
		} else{
			//else, remove higlight from everything else first, then add highlight to "clicked"
			$('.table-report tr').children('td').removeClass('mouseclick');
			$('.table-report tr:nth-child(' + (rIdx + 1) + ')').children('td').addClass('mouseclick');
		}
	});
});
function convertIntToTime (num) {
    var mins = Math.floor(num/60);
    var secs = num % 60;
    var timerOutput = (mins < 10 ? "0" : "" ) + mins + ":" + (secs < 10 ? "0" : "" ) + secs;
    return(timerOutput);
}