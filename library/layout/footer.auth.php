
                </div>
            </div>
        </div>
        
        <footer class="footer d-none d-md-block footer-static footer-light">
        <p class="clearfix blue-grey lighten-2 mb-0">
            <span class="float-md-left d-block d-md-inline-block mt-25">
                2019 - <?= date('Y') ?> &copy; <a class="text-primary darken-2" href="#" target="_blank"><b><?= $_CONFIG['title'] ?></b>,</a>All rights Reserved
            </span>
            <span class="float-md-right d-none d-md-block">Page Load: <?= $page_load_total ?>s.<i class="feather icon-heart pink"></i></span>
            <button class="btn btn-primary btn-icon scroll-top" type="button"><i class="feather icon-arrow-up"></i></button>
        </p>
    </footer>
        
        <script src="<?= assets('vendors/js/vendors.min.js') ?>"></script>
        
        <!-- js untuk select2  -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <!-- end select2 -->
        
        <!-- BEGIN: Theme JS-->
        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <script src="<?= assets('js/core/app-menu.min.js') ?>"></script>
        <script src="<?= assets('js/core/app.min.pretest.js') ?>"></script>
        <script src="<?= assets('js/scripts/components.min.js') ?>"></script>
        <script src="<?= assets('js/scripts/show-password.min.js') ?>"></script>
        <!-- END: Theme JS-->       
          <script>
        //   Loading screen
        $(document).ready(function() {
            $(".preloader").fadeOut("slow");
        })
        </script>
    </body>
</html>