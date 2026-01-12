<section class="yelyel-section">
    <div class="yelyel-container">

        <div class="yelyel-header">
            <h2>Galeri Multimedia</h2>
            <p>Dokumentasi Yel-Yel & Podcast RESAMBASRA</p>
        </div>

        <div class="yelyel-wrap">

            <div class="yelyel-text" id="textContent">
                <span class="yelyel-badge" id="badgeText">Yel-Yel</span>
                <div class="yelyel-title">
                    <h2 id="titleText">Loading...</h2>
                </div>
                <div class="yelyel-desc" id="descText"></div>
            </div>

            <div class="yelyel-video-wrapper">

                <button class="yelyel-nav-btn nav-left" onclick="changeVideo(-1)">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>

                <div class="yelyel-video-container" id="videoContainer">

                    <div class="thumb-layer" id="thumbLayer" onclick="playCurrentVideo()">
                        <img id="videoThumbnail" src="" alt="Video Thumbnail" class="video-thumb">
                        <div class="play-icon">
                            <i class="fa-solid fa-play"></i>
                        </div>
                    </div>

                    <iframe
                        id="videoFrame"
                        src=""
                        title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin"
                        allowfullscreen>
                    </iframe>
                </div>

                <button class="yelyel-nav-btn nav-right" onclick="changeVideo(1)">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>

            </div>

        </div>
    </div>
</section>
