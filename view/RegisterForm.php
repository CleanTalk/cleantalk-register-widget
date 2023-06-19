<div class="cleantalk_register_widget">
    <div class="text-center">
        <div id="help_hint" class="notice_hint"></div>
    </div>
    <form method="post" id="reg">
        <input type="hidden" name="method_name" value="get_api_key">
        <input type="hidden" name="product_name" value="antispam">
        <div class="text-center">
            <div class="flexbox">
                <h2 class="cleantalk-register-widget-title">{{TITLE}}</h2>
            </div>
            <div style="margin-top: 2em">
                <div class="text-center">
                    <label for="email"></label>
                    <input type="email" name="email" id="email" value="" class="text" placeholder="Email address" required="" style="width: 100%"><br>
                    <label for="site"></label>
                    <input type="text" name="website" id="site" value="" class="text" placeholder="Website address" required="" style="width: 100%"><br>
                </div>
            </div>
            <div class="text-center">
                <input type="submit" id="submit_btn" class="button --reg" value="{{SUBMIT_BUTTON_TEXT}}" style="width: 100%">
            </div>
            <div class="text-center">
                <div style="padding-bottom: 1.0em;" class="grey_text s10pt_text">{{PUBLIC_OFFER}} {{LOGIN_LINK}}</div>
            </div>
        </div>
    </form>
</div>