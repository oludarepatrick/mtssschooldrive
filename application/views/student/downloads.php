<style type="text/css">
    .panel .content p {
        color: #AE1818;
    }

    .content {
        padding: 5%;
    }
</style>
<div class="m-content">
    <div class="tabcontrol" data-role="tabcontrol">
        <ul class="tabs">
            <li><a href="#frame_1">Time Table</a></li>
            <li><a href="#frame_2">Scheme of Work</a></li>
            <li><a href="#frame_3">School Theme</a></li>
            <li><a href="#frame_4">General</a></li>
        </ul>
        <div class="frames">
            <div class="frame" id="frame_1">
                <div class="panel">
                    <div class="heading">
                        <span class="title">Time Table Download</span>
                    </div>
                    <div class="content">
                       <p>Click<a class="dl-link" href="gettimetable"> here </a>to download the timetable</p>
                    </div>
                </div>
            </div>
            <div class="frame" id="frame_2">
                <div class="panel">
                    <div class="heading">
                        <span class="title">Scheme of Work Download</span>
                    </div>
                    <div class="content">
                       <p>Click<a class="dl-link" href="getschemeofwork"> here </a>to download the scheme of work</p>
                    </div>
                </div>
            </div>
            <div class="frame" id="frame_3">
            <div class="panel">
                    <div class="heading">
                        <span class="title">School Theme Download</span>
                    </div>
                    <div class="content">
                       <p>Click<a href="getschooltheme" style="text-decoration: underline;"> here </a>to download the School Theme</p>
                    </div>
                </div></div>
            <div class="frame" id="frame_4">
            <table class="table border striped">
            <thead>
            <tr>
            <th>S/N</th>
            <th>Title</th>
            <th>Description</th>
            <th>Download</th>
            </tr>
            </thead>
            <tbody>
            <?php $i=1; foreach($uploads as $up) {?>
            <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $up[0]->title; ?></td>
            <td><?php echo $up[0]->description; ?></td>
            <td><a href="<?php echo base_url()."uploads/general_upload/".$up[0]->filename; ?>"><span class="mif-download"></span>Download</a></td>
            </tr>
            <?php $i++;} ?>
            </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
