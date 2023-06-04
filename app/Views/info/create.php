<?= $this->extend('layout/default') ?>
<?= $this->section('title') ?>
Above IT
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="row">


    <div class="col-md-12 ">
    <?=form_open_multipart(site_url('/company-info/create'))?>
    <div class="mb-3">
    <label>Document Title:</label>
    <input type="text"   class="form-control"   name="title" value="<?=old('title')?>"  required="">
   
</div>

    <div class="mb-3">
    <label>Select Document Type:</label>
    <select name="type" class="form-control">
        <option value="">Choose Type</option>
        <option value="0">Company Information</option>
        <option value="1">Product Information</option>
        <option value="2">Service Information</option>
    </select>
    
   
</div>

    <div class="mb-3">
    <label>Upload Pdf Documnet:</label>
    <input type="file"   class="form-control" id="myPdf"  name="doc_link"  required="">
    <div class="row">
        <div class="col-md-6">
            <div class="text-center">
            <canvas id="pdfViewer"></canvas>
            </div>
        </div>
    </div>
   
</div>




<button  type="submit" class="btn btn-primary waves-effect waves-light mb-3">Upload Resume</button>


</form>
       

    </div><!-- end col -->
    </div>
<?= $this->endSection() ?>
<?=$this->section('custom-js')?>
<script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
<script>
    // Loaded via <script> tag, create shortcut to access PDF.js exports.
var pdfjsLib = window['pdfjs-dist/build/pdf'];
// The workerSrc property shall be specified.
pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://mozilla.github.io/pdf.js/build/pdf.worker.js';

$("#myPdf").on("change", function(e){
	var file = e.target.files[0]
	if(file.type == "application/pdf"){
		var fileReader = new FileReader();  
		fileReader.onload = function() {
			var pdfData = new Uint8Array(this.result);
			// Using DocumentInitParameters object to load binary data.
			var loadingTask = pdfjsLib.getDocument({data: pdfData});
			loadingTask.promise.then(function(pdf) {
			  console.log('PDF loaded');
			  
			  // Fetch the first page
			  var pageNumber = 1;
			  pdf.getPage(pageNumber).then(function(page) {
				console.log('Page loaded');
				
				var scale = 1;
				var viewport = page.getViewport({scale: scale});

				// Prepare canvas using PDF page dimensions
				var canvas = $("#pdfViewer")[0];
				var context = canvas.getContext('2d');
				canvas.height = viewport.height;
				canvas.width = viewport.width;

				// Render PDF page into canvas context
				var renderContext = {
				  canvasContext: context,
				  viewport: viewport
				};
				var renderTask = page.render(renderContext);
				renderTask.promise.then(function () {
				  console.log('Page rendered');
				});
			  });
			}, function (reason) {
			  // PDF loading error
			  console.error(reason);
			});
		};
		fileReader.readAsArrayBuffer(file);
	}
});
</script>
<?=$this->endSection()?>


