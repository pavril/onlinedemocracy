<style> #app-icon, #app-iphone-introduce {
    margin: 0;
    padding: 0;
    border: 0;
    font-size: 100%;
    vertical-align: baseline;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    
    z-index: 100000;
    
    background: #fff;
    position: fixed;
    top:0;
    bottom:0;
    left:0;
    right:0;
}

#app-icon a, #app-icon a:focus, #app-icon a:hover, #app-icon a:active {
    color: inherit;
    text-decoration: none
}

#headerBox {
    width: 100%;
    height: 48px;
    border-bottom: .5px solid #979797;
    background-color: #F6F6F6;
    text-align: center
}

#popoverBox {
    position: absolute;
    bottom: 15px;
    width: 290px;
    height: 132px;
    -webkit-border-radius: 11px;
    border-radius: 11px;
/*     background-color: #2891F7; */
	background-color: #81b33a;
    border: none;
    margin-left: -145px;
    left: 50%
}

#popoverBox:after {
    top: 100%;
    left: 50%;
    border: solid transparent;
    content: " ";
    height: 0;
    width: 0;
    position: absolute;
    pointer-events: none;
    border-color: rgba(40, 145, 247, 0);
/*     border-top-color: #2891F7; */
	border-top-color: #81b33a;
    border-width: 13px;
    margin-left: -13px
}

.icon {
    margin-bottom: 5px
}

#groupIconContainer {
    margin-left: 40px;
    width: 60px;
    float: left;
    height: 100%
}

#groupIcon {
    height: 60px;
    width: 60px;
    -webkit-border-radius: 14px;
    border-radius: 14px;
    background-color: #FFF;
    margin-top: 25px
}

#addToHomeIconContainer {
    margin-right: 40px;
    width: 60px;
    float: right;
    height: 100%
}

#addToHomeIcon {
    margin-top: 25px
}

#arrow {
    margin: 0 auto;
    display: block;
    margin-top: 49px
}

#infoText {
    color: #141823;
    font-size: 18px;
    line-height: 28px;
    text-align: center;
    width: 280px;
    height: 160px;
    margin: auto;
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0
}

.iconLabelContainer {
    font-size: 12px;
    color: #FFF;
    line-height: 14px;
    width: 100px;
    height: 30px;
    margin-left: -20px;
    text-align: center
}

#groupCoverImage {
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    background-size: cover;
    background-position: center;
    background-image: url('{{ asset('img/app-icon.png') }}');
    width: 52px;
    height: 52px;
    border-radius: 50%;
    position: relative;
    top: 4px;
    left: 4px;
    border: 0.5px solid rgba(0, 0, 0, 0.10);
}

</style>

<div id="app-iphone-introduce" style="display:none;">
	<div class="container text-center"">
		<img src="{{ asset('img/iphone6_spacegrey_portrait.png') }}" alt="App preview" style="width: 300px; margin-top: -270px; margin-bottom: 10px;">
		
		<h3 style="line-height: 1.3;">Save DirectDemocracy <br>on your home screen!</h3>
		
		<a id="open-app-icon" style="margin-top: 20px; font-size: 120%" href="#" class="btn btn-success">Yes, let's do it! <i class="material-icons">arrow_forward</i></a>
		
		<a id="close-app-iphone-introduce" href="#" style="margin-top: 25px; display: block;" class="small text-muted">Get me to the website</a>
		
	</div>
</div>

<div id="app-icon" style="display:none;">
    <div id="headerBox"><span style="font-size:17px;color:#2891F7;line-height:20px;position:relative;top:13.5px"><a href="#" id="cancel-app-icon">Cancel</a></span></div>
    <div id="infoText">Tap the
        <svg style="vertical-align:text-bottom" width="22px" height="30px" viewbox="0 0 44 60" version="1.1">
            <defs></defs>
            <g id="Final" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <g id="Add-Group-to-Home-Screen" transform="translate(-299.000000, -459.000000)">
                    <g id="Tap-+-below-+-Share-Icon" transform="translate(231.000000, 458.000000)">
                        <g id="share-icon" transform="translate(60.000000, 0.000000)">
                            <path d="M20.4,12 L30,2.4 L39.6,12" id="Shape" stroke="#3F75FF" stroke-width="2"></path>
                            <path d="M30,39.0000013 L30,2.7996" id="Shape" stroke="#3F75FF" stroke-width="2"></path>
                            <rect id="Rectangle-path" x="0" y="0" width="60" height="60"></rect>
                            <path d="M20.2682927,20 L9,20 L9,60 L51,60 L51,20 L39.7317073,20" id="Shape" stroke="#3F75FF" stroke-width="2"></path>
                        </g>
                    </g>
                </g>
            </g>
        </svg> button below,
        <br>Then tap &ldquo;Add to Home Screen&rdquo;
    </div>
    <div id="popoverBox">
        <div id="groupIconContainer">
            
        	<img id="groupIcon" src="{{ asset('img/app-icon.png') }}">
            
            <div class="iconLabelContainer" style="padding-top: 10px;">DirectDemocracy</div>
        </div>
        <div id="addToHomeIconContainer">
            <svg id="addToHomeIcon" width="60px" height="60px" viewbox="0 0 120 120" version="1.1">
                <defs></defs>
                <g id="Add-Group-to-Home-Screen-Spec" transform="translate(-410.000000, -802.000000)">
                    <g id="Add-to-Home-Screen" transform="translate(367.000000, 802.000000)">
                        <g id="Add-to-Home-Screen-Icon" transform="translate(43.000000, 0.000000)">
                            <rect id="Rectangle-6" fill="#FFFFFF" x="0" y="0" width="120" height="120" rx="28"></rect>
                            <rect id="Rectangle-6" fill="#686870" x="25" y="25" width="70" height="70" rx="15"></rect>
                            <path d="M58,58 L58,46.991617 C58,45.8978404 58.8954305,45 60,45 C61.1122704,45 62,45.8916773 62,46.991617 L62,58 L73.008383,58 C74.1021596,58 75,58.8954305 75,60 C75,61.1122704 74.1083227,62 73.008383,62 L62,62 L62,73.008383 C62,74.1021596 61.1045695,75 60,75 C58.8877296,75 58,74.1083227 58,73.008383 L58,62 L46.991617,62 C45.8978404,62 45,61.1045695 45,60 C45,58.8877296 45.8916773,58 46.991617,58 L58,58 Z" id="Rectangle-8" fill="#FFFFFF"></path>
                        </g>
                    </g>
                </g>
            </svg>
            <div class="iconLabelContainer">Add to
                <br>Home Screen</div>
        </div>
        <svg id="arrow" width="12px" height="20px" viewbox="0 0 24 40" version="1.1">
            <defs></defs>
            <g id="Explorations" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <g id="Add-Group-to-Home-Screen" transform="translate(-307.000000, -847.000000)" stroke-linecap="round" stroke="#FFFFFF" stroke-width="5">
                    <g id="Group" sketch:type="MSLayerGroup" transform="translate(30.000000, 752.000000)">
                        <path d="M297,132 L280,115 L297,98" id="Path-35" transform="translate(288.500000, 115.000000) rotate(-180.000000) translate(-288.500000, -115.000000) "></path>
                    </g>
                </g>
            </g>
        </svg>
    </div>
    <div id="popoverNub"></div>
</div>