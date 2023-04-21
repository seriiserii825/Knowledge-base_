<iframe id="youtube_player" class="yt_player_iframe" width="640" height="360" src="http://www.youtube.com/embed/aHUBlv5_K8Y?enablejsapi=1&version=3&playerapiid=ytplayer"  allowfullscreen="true" allowscriptaccess="always" frameborder="0"></iframe>
and the following JS/jQuery code:

$('.yt_player_iframe').each(function(){
  this.contentWindow.postMessage('{"event":"command","func":"stopVideo","args":""}', '*')
});
