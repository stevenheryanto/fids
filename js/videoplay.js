/* non jquery - html5 video player */

var video;
var playlist;
var tracks;
var current;

function video_init(){
    current = 0;
    video = $('#video_dis');
    playlist = $('#playlist');
    tracks = playlist.find('li a');
    len = tracks.length - 1;
    video[0].volume = .20;
    video[0].play();
    playlist.find('a').click(function(e){
        e.preventDefault();
        link = $(this);
        current = link.parent().index();
        run(link, video[0]);
    });
    video[0].addEventListener('ended',function(e){
        current++;
        if(current == len){
            current = 0;
            link = playlist.find('a')[0];
        }else{
            link = playlist.find('a')[current];    
        }
        run($(link),video[0]);
    });
}
function run(link, player){
        player.src = link.attr('href');
        par = link.parent();
        par.addClass('active').siblings().removeClass('active');
        video[0].load();
        video[0].play();
}