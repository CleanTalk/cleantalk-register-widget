<div class="cleantalk_register_widget">
    <div class="text-center">
        <div id="help_hint" class="notice_hint"></div>
    </div>
    <form method="post" id="reg">
        <input type="hidden" name="method_name" value="get_api_key">
        <input type="hidden" name="product_name" value="antispam">
        <div class="text-center">
            <div class="flexbox">
                <img src="https://cleantalk.org/images/cleantalk-logo-60-2.webp" class="main_page_log" title="" alt="CleanTalk logo">
                <div class="align_left">{{TITLE}}</div>
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
                <div class="grey_text s10pt_text">{{HINT}}</div>
                <div class="light_text s10pt_text">{{PUBLIC_OFFER}}</div>
            </div>
            <div class="text-center" style="margin-top: 2em">
                <input type="submit" id="submit_btn" class="button --reg" value="CREATE ACCOUNT" style="width: 100%">
            </div>
            <div class="text-center">
                <div style="padding-bottom: 1.0em;" class="grey_text s10pt_text">{{LOGIN_LINK}}</div>
            </div>
        </div>
    </form>
</div>