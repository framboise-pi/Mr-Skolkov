<?php
/*
 * Mr.SKOLKOV
 * LAFONTAINE Cédric Camille - codelibre.fr - tous droits reservés
 * https://github.com/framboise-pi/
 * core/avatar.inc.php
 * code mainly taken from multiavatar demo page
*/
?>

<style>

      .mono {
        font-family: "SF Mono", "Monaco", "Andale Mono", "Lucida Console", "Bitstream Vera Sans Mono", "Courier New", Courier, monospace;
        font-size: 18px;
      }

      .centered {
        text-align: center;
        padding-left: 10px;
        padding-right: 10px;
        max-width: 600px;
        margin: 0 auto;
        padding-top: 20px;
      }

      .heading {
        font-size:26px;
        font-weight:bold;
        line-height:120%;
      }

      #identicon {
        width: 220px;
        height: 220px;
        margin: 0 auto;
        display: inline-block;
      }

      #identicon-input {
        width:100%;
        padding:4px;
        padding-left:14px;
        padding-right:14px;
        text-align:center;
        padding-top: 6px;
        border: 0;
        border-bottom: 1px solid rgb(172, 172, 172);
        overflow: hidden;
        text-overflow: ellipsis;
        color: #111;
        background-color: #ffffff00;
      }

      #identicon-input:focus {
        outline: none;
      }

      #button-png:hover {
        background-color:#f6ecff;
      }
      
      .buttons {
        display:inline-block;
        width:40px;
        box-sizing:border-box;
        padding:5px;
      }

      .svg-button {
        fill:#6a6b6c;
        fill-rule:evenodd;
        cursor:pointer;
      }

      .svg-button:hover {
        fill:#868789;
      }

      .ma-spinner {
        display: inline-block;
        position: relative;
        width: 56px;
        height: 56px;
        margin-top: 90px;
      }

      .ma-spinner div {
        position: absolute;
        border: 4px solid #ababab;
        opacity: 1;
        border-radius: 50%;
        animation: ma-spinner 1s cubic-bezier(0, 0.2, 0.8, 1) infinite;
      }
      .ma-spinner div:nth-child(2) {
        animation-delay: -0.5s;
      }
      @keyframes ma-spinner {
        0% {
          top: 23px;
          left: 23px;
          width: 0;
          height: 0;
          opacity: 1;
        }
        100% {
          top: 0px;
          left: 0px;
          width: 46px;
          height: 46px;
          opacity: 0;
        }
      }

      .noselect {
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }
    </style>

<div class="centered">
      
  <div style="height:40px;"></div>

  <a class="identicon-link" id="identicon-link" target="_blank">
    <div id="identicon">
      <div class="ma-spinner">
        <div></div>
        <div></div>
      </div>
    </div>
  </a>

  <div style="height:40px;"></div>

    <form method="POST" action="index.php">

    <div style="max-width:240px;margin: 0 auto;">
        <input name="avatar_string" type="text" oninput="getNewIdenticon(this.value)" onfocus="stopDemoNow()"id="identicon-input" class="mono">
    </div>

    <div style="height:20px;"></div>

    <div class="noselect">
      <div class="buttons">
        <div style="cursor:pointer;" onclick="newIdenticon()">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 60"><title>New (N)</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path d="M30,0A30,30,0,1,1,0,30,30,30,0,0,1,30,0Z" class="svg-button" /><path d="M43.11,43.11A18.56,18.56,0,0,0,31.89,11.55a1.45,1.45,0,0,0-1.12.37A1.39,1.39,0,0,0,30.3,13v.17a1.44,1.44,0,0,0,1.29,1.43A15.5,15.5,0,0,1,41,41l-.35.35a.6.6,0,0,1-.85,0l-3.23-3.23a.6.6,0,0,0-1,.42V48a.6.6,0,0,0,.6.6h9.47a.58.58,0,0,0,.55-.37.57.57,0,0,0-.13-.65L42.76,44.3a.6.6,0,0,1,0-.84l.35-.35ZM14.51,30A15.44,15.44,0,0,1,19,19l.35-.34a.58.58,0,0,1,.84,0l3.24,3.23a.6.6,0,0,0,1-.42V12a.6.6,0,0,0-.6-.6H14.42a.58.58,0,0,0-.55.37.57.57,0,0,0,.13.65l3.24,3.24a.6.6,0,0,1,0,.84l-.35.35A18.55,18.55,0,0,0,28.11,48.45,1.46,1.46,0,0,0,29.7,47v-.16a1.44,1.44,0,0,0-1.29-1.44A15.51,15.51,0,0,1,14.51,30Z" style="fill:#fff;pointer-events: none;"/></g></g></svg>
        </div>
      </div>
      
      <button type="submit" class="btn btn-success" name="">Enregistrer</button>
      </form>
      
    </div>

    <div style="height:20px;" id="uniqueString"></div>

  </div>

    <!-- DEVELOPMENT -->
    <script type="text/javascript" src="./core/lib/js/multiavatar.js?v=013"></script>

    <!-- PRODUCTION -->
    <!-- <script type="text/javascript" src="multiavatar.min.js?v=002"></script> -->

    <script>
      /*
      CryptoJS v3.1.2
      code.google.com/p/crypto-js
      (c) 2009-2013 by Jeff Mott. All rights reserved.
      code.google.com/p/crypto-js/wiki/License
      */
      var CryptoJS=CryptoJS||function(h,s){var f={},t=f.lib={},g=function(){},j=t.Base={extend:function(a){g.prototype=this;var c=new g;a&&c.mixIn(a);c.hasOwnProperty("init")||(c.init=function(){c.$super.init.apply(this,arguments)});c.init.prototype=c;c.$super=this;return c},create:function(){var a=this.extend();a.init.apply(a,arguments);return a},init:function(){},mixIn:function(a){for(var c in a)a.hasOwnProperty(c)&&(this[c]=a[c]);a.hasOwnProperty("toString")&&(this.toString=a.toString)},clone:function(){return this.init.prototype.extend(this)}},
      q=t.WordArray=j.extend({init:function(a,c){a=this.words=a||[];this.sigBytes=c!=s?c:4*a.length},toString:function(a){return(a||u).stringify(this)},concat:function(a){var c=this.words,d=a.words,b=this.sigBytes;a=a.sigBytes;this.clamp();if(b%4)for(var e=0;e<a;e++)c[b+e>>>2]|=(d[e>>>2]>>>24-8*(e%4)&255)<<24-8*((b+e)%4);else if(65535<d.length)for(e=0;e<a;e+=4)c[b+e>>>2]=d[e>>>2];else c.push.apply(c,d);this.sigBytes+=a;return this},clamp:function(){var a=this.words,c=this.sigBytes;a[c>>>2]&=4294967295<<
      32-8*(c%4);a.length=h.ceil(c/4)},clone:function(){var a=j.clone.call(this);a.words=this.words.slice(0);return a},random:function(a){for(var c=[],d=0;d<a;d+=4)c.push(4294967296*h.random()|0);return new q.init(c,a)}}),v=f.enc={},u=v.Hex={stringify:function(a){var c=a.words;a=a.sigBytes;for(var d=[],b=0;b<a;b++){var e=c[b>>>2]>>>24-8*(b%4)&255;d.push((e>>>4).toString(16));d.push((e&15).toString(16))}return d.join("")},parse:function(a){for(var c=a.length,d=[],b=0;b<c;b+=2)d[b>>>3]|=parseInt(a.substr(b,
      2),16)<<24-4*(b%8);return new q.init(d,c/2)}},k=v.Latin1={stringify:function(a){var c=a.words;a=a.sigBytes;for(var d=[],b=0;b<a;b++)d.push(String.fromCharCode(c[b>>>2]>>>24-8*(b%4)&255));return d.join("")},parse:function(a){for(var c=a.length,d=[],b=0;b<c;b++)d[b>>>2]|=(a.charCodeAt(b)&255)<<24-8*(b%4);return new q.init(d,c)}},l=v.Utf8={stringify:function(a){try{return decodeURIComponent(escape(k.stringify(a)))}catch(c){throw Error("Malformed UTF-8 data");}},parse:function(a){return k.parse(unescape(encodeURIComponent(a)))}},
      x=t.BufferedBlockAlgorithm=j.extend({reset:function(){this._data=new q.init;this._nDataBytes=0},_append:function(a){"string"==typeof a&&(a=l.parse(a));this._data.concat(a);this._nDataBytes+=a.sigBytes},_process:function(a){var c=this._data,d=c.words,b=c.sigBytes,e=this.blockSize,f=b/(4*e),f=a?h.ceil(f):h.max((f|0)-this._minBufferSize,0);a=f*e;b=h.min(4*a,b);if(a){for(var m=0;m<a;m+=e)this._doProcessBlock(d,m);m=d.splice(0,a);c.sigBytes-=b}return new q.init(m,b)},clone:function(){var a=j.clone.call(this);
      a._data=this._data.clone();return a},_minBufferSize:0});t.Hasher=x.extend({cfg:j.extend(),init:function(a){this.cfg=this.cfg.extend(a);this.reset()},reset:function(){x.reset.call(this);this._doReset()},update:function(a){this._append(a);this._process();return this},finalize:function(a){a&&this._append(a);return this._doFinalize()},blockSize:16,_createHelper:function(a){return function(c,d){return(new a.init(d)).finalize(c)}},_createHmacHelper:function(a){return function(c,d){return(new w.HMAC.init(a,
      d)).finalize(c)}}});var w=f.algo={};return f}(Math);
      (function(h){for(var s=CryptoJS,f=s.lib,t=f.WordArray,g=f.Hasher,f=s.algo,j=[],q=[],v=function(a){return 4294967296*(a-(a|0))|0},u=2,k=0;64>k;){var l;a:{l=u;for(var x=h.sqrt(l),w=2;w<=x;w++)if(!(l%w)){l=!1;break a}l=!0}l&&(8>k&&(j[k]=v(h.pow(u,0.5))),q[k]=v(h.pow(u,1/3)),k++);u++}var a=[],f=f.SHA256=g.extend({_doReset:function(){this._hash=new t.init(j.slice(0))},_doProcessBlock:function(c,d){for(var b=this._hash.words,e=b[0],f=b[1],m=b[2],h=b[3],p=b[4],j=b[5],k=b[6],l=b[7],n=0;64>n;n++){if(16>n)a[n]=
      c[d+n]|0;else{var r=a[n-15],g=a[n-2];a[n]=((r<<25|r>>>7)^(r<<14|r>>>18)^r>>>3)+a[n-7]+((g<<15|g>>>17)^(g<<13|g>>>19)^g>>>10)+a[n-16]}r=l+((p<<26|p>>>6)^(p<<21|p>>>11)^(p<<7|p>>>25))+(p&j^~p&k)+q[n]+a[n];g=((e<<30|e>>>2)^(e<<19|e>>>13)^(e<<10|e>>>22))+(e&f^e&m^f&m);l=k;k=j;j=p;p=h+r|0;h=m;m=f;f=e;e=r+g|0}b[0]=b[0]+e|0;b[1]=b[1]+f|0;b[2]=b[2]+m|0;b[3]=b[3]+h|0;b[4]=b[4]+p|0;b[5]=b[5]+j|0;b[6]=b[6]+k|0;b[7]=b[7]+l|0},_doFinalize:function(){var a=this._data,d=a.words,b=8*this._nDataBytes,e=8*a.sigBytes;
      d[e>>>5]|=128<<24-e%32;d[(e+64>>>9<<4)+14]=h.floor(b/4294967296);d[(e+64>>>9<<4)+15]=b;a.sigBytes=4*d.length;this._process();return this._hash},clone:function(){var a=g.clone.call(this);a._hash=this._hash.clone();return a}});s.SHA256=g._createHelper(f);s.HmacSHA256=g._createHmacHelper(f)})(Math);

    </script>

    <script>
      // Demo avatars for home page
      demoAvatars = [
        'Clementine',
        'Morty',
        'Rodion Raskolnikov',
        'Sam Solo',
        'Starcrasher',
        'Shack',
        'Desmond',
        'Snake Harrison',
        'Pandemonium',
        'Broomhilda',
        'Cosmo Blue',
        'Blue Meal Shake',
        'Cryptonaut',
        'Lancaster',
        'Maggot',
        'Matrix',
        'Hiro',
        'Mavericat',
        'Huxley',
        'Elton David-Black',
        'Katerina Zoo',
        'Bloomdalf',
        'Emma',
        'The Elephant\'s Cat',
        'Nigel Ziemssen',
        'Sir Henchard',
        'Philip Klaus',
        'Daniel Marlowe',
        'Joachim Molesworth',
        'Molly Deronda',
        'Protagonist',
        'Lancelot',
        'Pechorin Bloom',
        'Kim',
        'Kim Patel',
        'Lorelei',
        'Battle Wooster',
        'Horatius',
        'Rhett James',
        'Moby Dick',
        'James Bolling',
        'Binx Bond',
        'Patrick Gatsby',
        'Inigo Argo',
        'Jay Bateman',
        'Victor Montoya',
        'Angela Flagg',
        'Randall Zone',
        'Major Salt',
        'Milo Minderbender',
        'Major Machine',
        'Skeleto',
        'Heep Starr',
        '11th Monster',
        'Wunderlick',
        'Big Brother',
        'Gonlithli',
        'Ebenezer Dimmsdale',
        'Hester Vega',
        'Honey Bunny',
        'Vincent Plant',
        'Butch Wallace',
        'Marsellus Coolidge',
        'Tuco',
        'Angel Boy',
        'Pablo Grimes',
        'Bounty Hunter',
        'Agent Smith',
        'Oracle',
        'Apoc State',
        'Switch',
        'Choi',
        'Angel Eyes',
        'Spoon Eyes',
        'Papillon',
        'Snooze 11',
        'Projectionist',
        'Landlady',
        'Ned Ramirez',
        'Michael Shimada',
        'Sonny Zen',
        'Bruno Fox',
        'Joker',
        'Lucius Tattaglia',
        'Scareblow',
        'Sugar Crash',
        'Neurostatic',
        'Kambei Corleone',
        'Shichiroji Karatoza',
        'Kuninori Bun Lord',
        'Bun Pusher',
        'Etno',
        'Wiggly Corleone',
        'Magnetofon',
        'Hitpagadee',
        'Doge',
        'Doge Panda',
        'Doge Locamotiv',
        'Doge Bulls',
        'Doge Lavrinovich',
        'Weeberblitz',
        'Arkadion',
        'Ninesouls',
        'Psycat',
        'Indoqueen',
        'DoubleDanceDragon',
        'Kinestetic Moves',
        'Zen Flash',
        'Orbit Escape',
        'Sin Azucar',
        'Particle Machine',
        'Spanglinga',
        'Pandalion',
        'Music Razor',
        'Bugzilla',
        'Bugz Bunuel',
        'Satoshi',
        'Nakamoto',
        'МЦ ДРУИД',
        'Jekaterina',
        'Quito',
        'Buenos Aires',
        'Ouarzazate',
        'Bogota',
        'Essaouira',
        'Extremadura',
        'Guadalajara',
        'Aphex',
        'Squarepusher',
        'Orbital',
        'Mozart',
        'Tesla',
        'Linux',
        'Ki',
        'Eshkoshka',
        'Aphex Maiden',
        'Iron Twin',
      ]

      var randomDemo = demoAvatars[Math.floor(Math.random()*demoAvatars.length)];
      demoAvatars.splice(demoAvatars.indexOf(randomDemo), 1);

      // Generate initial avatar
      getById('identicon-input').value = randomDemo;
      var iSVG = multiavatar(randomDemo);
      getById('identicon').innerHTML = iSVG;

      <?php $ze_svg = '$iSVG'; ?>

      var uniqueString = getById('identicon-input');
      //uniqueString.innerHTML = customUrl;

      // Update links
      var links = document.getElementsByClassName('link-back');
      for (var i=0, len=links.length|0; i<len; i=i+1|0) {
        links[i].setAttribute('href', 'https://multiavatar.com');
      }

      function updateLinks(link) {
        var links = document.getElementsByClassName('identicon-link');
        for (var i=0, len=links.length|0; i<len; i=i+1|0) {
          links[i].setAttribute('href', 'https://multiavatar.com/'+link);
        }
        
      }
      updateLinks(randomDemo);

      // Default demo to generate random avatars

      var liAddress = randomDemo;

      function identiconDemo() {
        if (liAddress.length > 0) {
          setTimeout(function() {
            liAddress = liAddress.substring(0, liAddress.length - 1);
            getById('identicon-input').value = liAddress;
            var iSVG = multiavatar(liAddress);
      
            getById('identicon').innerHTML = iSVG;

            updateLinks(liAddress);

            identiconDemo();
          }, 30)
        }
        else {
          createNew();
        }
      }

      liNewAddress = "";
      newA = ""

      function createNew() {
        
        if (newA.length != liNewAddressLength) {
          setTimeout(function() {
            newA += liNewAddress.substring(1,0);
            liNewAddress = liNewAddress.substring(1);
            getById('identicon-input').value = newA;
            var iSVG = multiavatar(newA);

            getById('identicon').innerHTML = iSVG;

            updateLinks(liNewAddress);

            createNew();
          }, 30)
        }
        else {
          liAddress = newA;
          newA = "";
          runDemo();
          // console.log('end');
          
          updateLinks(liAddress);
        }
      }

      function getNewIdenticon(string) {
        if (string == '') {
          var loaderHtml = '<div class="ma-spinner"><div></div><div></div></div>';
          getById('identicon').innerHTML = loaderHtml;
        }
        else {
          var iSVG = multiavatar(string);
          liAddress = string;
          getById('identicon').innerHTML = iSVG;
          
          updateLinks(string);
        }
      }

      stopDemo = false;

      function stopDemoNow() {
        stopDemo = true;
      }

      function runDemo() {
        if (stopDemo) { return; }
        setTimeout(function() {
          if (stopDemo) { return; }
          if(demoAvatars.length != 0) {
            liNewAddress = demoAvatars[Math.floor(Math.random()*demoAvatars.length)];
            liNewAddressLength = liNewAddress.length;
            identiconDemo();
            demoAvatars.splice(demoAvatars.indexOf(liNewAddress), 1);
          }
        }, 3000)
      }

      if (customUrl.length == 0) {
        runDemo();
      }
      
      // "New" button press
      function newIdenticon() {
        // document.body.style.backgroundColor = '#fff';
        stopDemoNow();

        var randomHash = CryptoJS.SHA256(''+Math.random()).toString().substring(0,20);
        var randomHashConstructed = '';

        function runIt() {
          setTimeout(function() {
            if (randomHashConstructed.length < 20) {
              var lastChar = randomHash.substring(randomHash.length - 1);
              randomHash = randomHash.slice(0, -1);
              // console.log(randomHash);

              randomHashConstructed += lastChar;
              // console.log(randomHashConstructed)

              getNewIdenticon(randomHashConstructed);
              getById('identicon-input').value = randomHashConstructed;
              runIt();
            }
          }, 3)
        }
        runIt();
      }

      // New on N key press
      document.onkeydown = function(evt) {
        if (evt.srcElement.nodeName != "INPUT") {
          evt = evt || window.event;
          var isN = false;
          if ("key" in evt) {
            isN = (evt.key === "n" || evt.key === "N");
          } else {
            isN = (evt.keyCode === 78);
          }
          if (isN) {
            newIdenticon();
          }
        }
      };

      // Helper functions

      function getById(id) {
        return document.getElementById(id);
      }

      function divHide(id) {
        document.getElementById(id).style.display = 'none';
      }

      function divShow(id) {
        document.getElementById(id).style.display = "block";
      }
    </script>
