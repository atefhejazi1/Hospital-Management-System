// This script tag loads before livewire.js in the page, and 'livewire:init'
// fires synchronously as soon as livewire.js executes - before
// DOMContentLoaded, i.e. before jQuery's $(document).ready below would ever
// run. Registering this listener has to happen at top level (immediately),
// not nested inside the ready callback, or the event is missed entirely.
//
// #ChatBody is overflow:hidden in CSS and relies entirely on
// PerfectScrollbar's JS to be scrollable - plain .scrollTop has no effect on
// an overflow:hidden element. #ChatBody only exists once a conversation is
// selected, so the instance is created lazily here on first use. Once it
// exists, new messages morphed in by Livewire still need .update() to
// recalculate the scroll height, or they render past the old boundary and
// stay invisible.
document.addEventListener('livewire:init', function () {
	Livewire.hook('morph.updated', function ({ component }) {
		if (component.name !== 'chat.chatbox') {
			return;
		}
		const chatBody = document.getElementById('ChatBody');
		if (!chatBody) {
			return;
		}
		if (!window.ChatBodyPS) {
			try {
				window.ChatBodyPS = new PerfectScrollbar(chatBody, { suppressScrollX: true });
			} catch (e) {
				return;
			}
		} else {
			window.ChatBodyPS.update();
		}
		chatBody.scrollTop = chatBody.scrollHeight;
	});
});

$(function() {
	'use strict'
	$('#chatActiveContacts').lightSlider({
		autoWidth: true,
		controls: false,
		pager: false,
		slideMargin: 12
	});
	if (window.matchMedia('(min-width: 992px)').matches) {
		// #ChatBody/#ChatList only exist once a conversation is selected (or
		// the list has entries) - PerfectScrollbar throws on a missing
		// target, which used to silently abort every line below this block.
		try {
			new PerfectScrollbar('#ChatList', {
				suppressScrollX: true
			});
			window.ChatBodyPS = new PerfectScrollbar('#ChatBody', {
				suppressScrollX: true
			});
			$('#ChatBody').scrollTop($('#ChatBody').prop('scrollHeight'));
		} catch (e) {
			// no conversation open yet on first load - nothing to scroll.
		}
	}

	$('.main-chat-list .media').on('click touch', function() {
		$(this).addClass('selected').removeClass('new');
		$(this).siblings().removeClass('selected');
		if (window.matchMedia('(max-width: 991px)').matches) {
			$('body').addClass('main-content-body-show');
			$('html body').scrollTop($('html body').prop('scrollHeight'));
		}
	});
	$('[data-toggle="tooltip"]').tooltip();
	$('#ChatBodyHide').on('click touch', function(e) {
		e.preventDefault();
		$('body').removeClass('main-content-body-show');
	})
});