<section class="wrapper bg-light">
  <div class="container-card">
    <div class="card image-wrapper bg-full bg-image mt-2 mb-0" data-image-src="<?php echo $this->website->banner() ?>">
      <div class="card-body py-10 px-0">
        <div class="container">
          <div class="row gx-md-8 gx-xl-12 gy-10 align-items-center text-center text-lg-start">
            <div class="col-lg-6" data-cues="slideInDown" data-group="page-title" data-delay="900">
              <h1 class="display-4 mb-4 me-xl-5 me-xxl-0 text-haqi"><?php echo $slider->judul_galeri ?></h1>
              <p class="lead fs-23 lh-sm mb-7 pe-xxl-15 text-white"><?php echo strip_tags($slider->isi) ?></p>
              <div>
                <a href="<?php echo $slider->website ?>" class="btn btn-lg btn-primary rounded">
                  <?php echo $slider->text_website ?> &nbsp;<i class="fa fa-arrow-right ml-2"></i>
                </a>
                <button type="button" class="btn btn-success btn-lg rounded text-white" data-bs-toggle="modal" data-bs-target="#VideoModal">
                  Lihat Video &nbsp;<i class="fa fa-play-circle"></i>
                </button>
              </div>
            </div>
            <!--/column -->
            <div class="col-lg-6">
              <img class="img-fluid rounded shadow-black" src="<?php echo base_url('assets/upload/image/'.$slider->gambar) ?>" srcset="<?php echo base_url('assets/upload/image/'.$slider->gambar) ?> 2x" data-cue="fadeIn" data-delay="300" alt="" />
            </div>
            <!--/column -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container -->
      </div>
      <!--/.card-body -->
    </div>
    <!--/.card -->
  </div>
  <!-- /.container-card -->
</section>

<!-- Modal -->
<div class="modal fade" id="VideoModal" tabindex="-1" aria-labelledby="VideoModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
     
      <div class="modal-body">
         <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="ratio ratio-16x9 rounded shadow-lg border border-secondary p-2">
          <iframe src="https://www.youtube.com/embed/<?php echo $site->link_video ?>" title="<?php echo $this->website->namaweb() ?>" allowfullscreen></iframe>
      </div>
      </div>
      
    </div>
  </div>
</div>



