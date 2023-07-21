<div class="cleantalk_register_widget">
    <div class="text-center">
        <div id="help_hint" class="notice_hint"></div>
    </div>
    <form method="post" id="reg">
        <input type="hidden" name="action" value="cleantalk_register_widget__get_api_key">
        <input type="hidden" name="current_url" value="{{CURRENT_URL}}">
        <input type="hidden" name="_ajax_nonce" value="{{NONCE}}">
        <div class="text-center">
            <div class="flexbox">
                <h2 class="cleantalk-register-widget-title">{{TITLE}}</h2>
            </div>
            <div class="text-center">
                <label for="email"></label>
                <input type="email" name="email" id="email" value="" class="text" placeholder="Email address" required="" style="width: 100%"><br>
                <label for="site"></label>
                <input type="text" name="website" id="site" value="" class="text" placeholder="Website address" required="" style="width: 100%"><br>
            </div>
            <div class="text-center">
                <input type="submit" id="submit_btn" class="button --reg" value="{{SUBMIT_BUTTON_TEXT}}" style="width: 100%; margin-bottom: 10px;">
            </div>
            <div class="text-center">
                <div style="padding-bottom: 1.0em;" class="grey_text s10pt_text">{{PUBLIC_OFFER}} {{LOGIN_LINK}}</div>
            </div>
        </div>
    </form>
</div>