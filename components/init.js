(function(window) {
  alert(1);
  window.initPlayer = function(id, options) {
    var player = videojs(id, options);
    return player;
  };
})(window);
