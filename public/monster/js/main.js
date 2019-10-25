var trigger = document.createElement('div');
	trigger.id = "trigger";
	trigger.innerText = "Trigger";
	document.body.prepend(trigger);

	document.getElementById('trigger').onclick = function(){
		showIframe();
		trigger.classList.add('disabled');
	}

function showIframe(){
	var div = document.getElementById('wrapper-iframe');

	var div = document.getElementById('wrapper-iframe');

	div.classList.remove('disabled');

	var n = 0;
	int = setInterval(function () {
		if (n >= 1) {
			n = 1;
			clearInterval(int);
		}
		n = n + 0.1;
		div.style.opacity = n;
		div.style.filter = 'alpha(opacity=' + 100*n + ')';
	}, 30);
}

document.getElementById('js-close-modal').onclick = function(){
	var div = document.getElementById('wrapper-iframe');

	var n = 1;

	int = setInterval(function () {
		if (n <= 0) {
			n = 0;
			clearInterval(int);
		}
		n = n - 0.1;
		div.style.opacity = n;
		div.style.filter = 'alpha(opacity=' + 100*n + ')';
	}, 30);


	div.classList.add('disabled');
}


function onMouseMove(event, end) {
    const eyes = document.getElementsByClassName("eye");
    for (let i in eyes) {
      const eye = eyes[i];
      if (eye.style) {
        if (end) {
          eye.style.transform = "rotate(190deg)";
        } else {
          const { x, y, width, height } = eye.getBoundingClientRect();
          const left = x + width / 2;
          const top = y + height / 2;
          const rad = Math.atan2(event.pageX - left, event.pageY - top);
          const degree = rad * (180 / Math.PI) * -1 + 180;
          eye.style.transform = "rotate(" + degree + "deg)";
        }
      }
    }
  }
  document.getElementById("balloon").onclick = e => {
    monsterDown();
    document.onmousemove = null;
    onMouseMove(e, "end");
  };
  document.onmousemove = onMouseMove;

  function monsterDown(){
    document.getElementById('lil-monster').style.animation = 'monsterDown 2s ease-in-out';
	setTimeout(()=> document.getElementById('lil-monster').style.display = 'none', 2000);
	showIframe();
	setTimeout(()=> showIframe(), 1000);
  }