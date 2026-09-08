function useIsEnglish () {
    const lang = document.querySelector('html').lang;
    return lang === 'en-US';
};

function useIsGerman () {
    const lang = document.querySelector('html').lang;
    return lang === 'de-DE';
};

function cookieNoticeTranslate() {
    const cookie_notice = document.querySelector('#cookie-notice');
    const cookie_notice_text = document.querySelector('#cn-notice-text');
    const cookie_notice_btn = document.querySelector('#cn-more-info');
    if (useIsEnglish()){
        cookie_notice_text.innerHTML = 'This site uses cookies, including third-party cookies, to guarantee you a better browsing experience. By closing this banner, scrolling this page or clicking any of its elements, you consent to the use of cookies.';
        cookie_notice_btn.innerHTML = 'More information';
    }else if(useIsGerman()){
        cookie_notice_text.innerHTML = 'Diese Website verwendet Cookies, einschließlich Cookies von Drittanbietern, um Ihnen ein besseres Surferlebnis zu gewährleisten. Indem Sie dieses Banner schließen, auf dieser Seite scrollen oder auf eines ihrer Elemente klicken, stimmen Sie der Verwendung von Cookies zu.';
        cookie_notice_btn.innerHTML = 'Mehr Informationen';
    }
}
