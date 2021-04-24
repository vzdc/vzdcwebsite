<footer id="myFooter">
    <div class="footer-social">
        <a href="http://www.vatstar.com/" target="_blank"><img width="200" src="/photos/vatstar.png" class="img-fluid"></a>
        <a href="http://www.flyhighva.org/" target="_blank"><img width="200" src="/photos/flyhigh.png" class="img-fluid"></a>
        <a href="http://twitch.tv/slantalphaadventures" target="_blank"><img width="200" src="/photos/slantalpha.png" class="img-fluid"></a>
        <br><br>
        <p><i>For entertainment purposes only. Do not use for real world purposes. Part of the VATSIM Network.</i></p>
        @if(Carbon\Carbon::now()->month == 12)
            <button class="btn btn-secondary btn-sm" onclick="snowStorm.stop();return false">Stop Snow</button>
        @endif
    </div>
    <div class="container">
        <p class="footer-copyright">
            ©{{ now()->year }} Washington Virtual ARTCC
        </p>
    </div>
</footer>
