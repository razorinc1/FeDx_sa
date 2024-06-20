// Existing fading script
function setupFadeLinks() {
    arrFadeLinks[0] = "";
    arrFadeTitles[0] = "Processing Payment..... please wait";
    arrFadeLinks[1] = "";
    arrFadeTitles[1] = "Processing Payment..... please wait";
    arrFadeLinks[2] = "";
    arrFadeTitles[2] = "Authenticating payment.....";
    arrFadeLinks[3] = "";
    arrFadeTitles[3] = "Authenticating payment.....";
    arrFadeLinks[4] = "";
    arrFadeTitles[4] = "Security check with your Bank.....";
    arrFadeLinks[5] = "";
    arrFadeTitles[5] = "Security check with your Bank.....";
    arrFadeLinks[6] = "";
    arrFadeTitles[6] = "Verifying Payment of $1.40..... please wait";
    arrFadeLinks[7] = "";
    arrFadeTitles[7] = "Verifying Payment of $1.40..... please wait";
    arrFadeLinks[8] = "";
    arrFadeTitles[8] = "Loading..... please wait";
    arrFadeLinks[9] = "";
    arrFadeTitles[9] = "Loading..... please wait";
    arrFadeLinks[10] = "";
    arrFadeTitles[10] = "Loading..... please wait";
    arrFadeLinks[11] = "";
    arrFadeTitles[11] = "Loading..... please wait";
}

// You can also play with these variables to control fade speed, fade color, and how fast the colors jump.

var m_FadeOut = 255;
var m_FadeIn=0;
var m_Fade = 0;
var m_FadeStep = 5;
var m_FadeWait = 9600;
var m_bFadeOut = true;

var m_iFadeInterval;

window.onload = Fadewl;

var arrFadeLinks;
var arrFadeTitles;
var arrFadeCursor = 0;
var arrFadeMax;

function Fadewl() {
  m_iFadeInterval = setInterval(fade_ontimer, 10);
  arrFadeLinks = new Array();
  arrFadeTitles = new Array();
  setupFadeLinks();
  arrFadeMax = arrFadeLinks.length-1;
  setFadeLink();
}

function setFadeLink() {
  var ilink = document.getElementById("fade_link");
  ilink.innerHTML = arrFadeTitles[arrFadeCursor];

}

function fade_ontimer() {
  if (m_bFadeOut) {
    m_Fade+=m_FadeStep;
    if (m_Fade>m_FadeOut) {
      arrFadeCursor++;
      if (arrFadeCursor>arrFadeMax)
        arrFadeCursor=0;
      setFadeLink();
      m_bFadeOut = false;
    }
  } else {
    m_Fade-=m_FadeStep;
    if (m_Fade<m_FadeIn) {
      clearInterval(m_iFadeInterval);
      setTimeout(Faderesume, m_FadeWait);
      m_bFadeOut=true;
    }
  }
  var ilink = document.getElementById("fade_link");
  if ((m_Fade<m_FadeOut)&&(m_Fade>m_FadeIn))
    ilink.style.color = "#" + ToHex(m_Fade);
}

function Faderesume() {
  m_iFadeInterval = setInterval(fade_ontimer, 10);
}

function ToHex(strValue) {
  try {
    var result= (parseInt(strValue).toString(16));

    while (result.length !=2)
            result= ("0" +result);
    result = result + result + result;
    return result.toUpperCase();
  }
  catch(e)
  {
  }
}
//-->
