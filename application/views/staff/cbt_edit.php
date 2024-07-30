<div class="m-content">
<h3>ADD QUESTIONS</h3>
<?php $question = json_decode($questions[0]->question);
//var_dump(json_decode($question[0]->options)); ?>
<div class="grid">
    <div class="row cells12">
        <div class="cell offset6 colspan4">
            <button class="button" id="add-question">Add Question</button>
            <button class="button" id="submit-exam">Submit Exam</button>
        </div>
    </div>
    <div class="row cells12">
        <div class="cell colspan12">
            <div class="tabcontrol" data-role="tabcontrol">
                <ul class="pagination"></ul>
                <ul class="tabs" id="questions-indicator">
                    <?php $i = 1; foreach($question as $q) { ?>
                        <li><a href="#question<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php $i++; } ?>
                </ul>
                <div class="frames" id="questions-container">
                    <?php $i = 1; foreach($question as $q) { ?>
                        <div class="frame" id="question<?php echo $i; ?>">
                            <div style="float: left">
                                <button class="button success add-option<?php echo $i; ?>">Add Option</button>
                                <textarea id="question<?php echo $i; ?>text"><?php echo $q->question_text; ?></textarea>
                            </div>
                            <div class="options" style="float: left; margin-left:20px; margin-top: 30px;">
                                <?php $opt = json_decode($q->options); foreach($opt as $o) { ?>
                                    <div class="option<?php echo $i; ?>" style="margin-bottom: 10px">
                                        <input type="radio" value="<?php echo $o; ?>" name="options<?php echo $i; ?>" <?php if($q->correct_option==$o){echo "checked";} ?>>&nbsp;&nbsp;
                                        <label><?php echo $o; ?></label>&nbsp;&nbsp;&nbsp;
                                        <i class="fa fa-pencil edit-option-modal" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-eraser delete-option" aria-hidden="true"></i></div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php $i++; } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="remodal" data-remodal-id="edit-option-modal">
    <button data-remodal-action="close" class="remodal-close"></button>
    <h2>Edit Option</h2>
    <div class="grid">
        <div class="row cells12">
            <div class="cell colspan4">
                <input type="text" id="option-edit" class="form-control">            
            </div>
      </div>
    </div>
    <br>
    <button data-remodal-action="cancel" class="remodal-cancel">Cancel</button>
    <button id="edit-option" class="remodal-confirm">OK</button>
</div>

<script>
<?php $i = 1; foreach($question as $q) { ?>
    tinymce.init({
            selector: '#question<?php echo $i; ?>text',
            width: 600,
            theme: 'modern',
            relative_urls: false,
            menubar: false,
            toolbar: [
                'undo redo | styleselect | bold italic | link jbimages',
                'alignleft aligncenter alignright'
            ],
            plugins : 'advlist autolink link image lists charmap print preview jbimages'
        });
        bindaddoption(<?php echo $i; ?>);
<?php $i++; } ?>
    bindeditoptionmodal();
    deleteoption();
    $('#submit-exam').on('click', function(){
        submitexam();
    })
    if($('.frames').children().length>1)
    {
	    $('.pagination').twbsPagination({
	    	startPage: 1,
	        totalPages: $('.tabs').children().length,
	        visiblePages: 7,
	        paginationClass: 'pagination',
	        pageClass: 'item',
	        activeClass: 'current',
	        first: '<<',
	        last: '>>',
	        nextClass: 'item',
	        lastClass: 'item',
	        firstClass: 'item',
	        prevClass: 'item',
	        onPageClick: function (event, page) {
	            $('#page-content').text('Page ' + page);
	            $('a[href=#question'+page+']').click();
	                CURRENT_PAGE = page;
	        }
	    });
}

    BASE_NUMBER = 1;
    START_NUMBER = <?php echo count($question)+1; ?>;
    QUESTIONS_CONTAINER = $('#questions-container');
    QUESTIONS_INDICATOR = $('#questions-indicator');
    OPTIONS_BASE_NUMBER = 1;
    CURRENT_PAGE = 0;
    function addQuestion()
    {
        QUESTIONS_INDICATOR.append('<li><a href="#question'+START_NUMBER+'">'+START_NUMBER+'</a></li>');
        QUESTIONS_CONTAINER.append('<div class="frame" id="question'+START_NUMBER+'"><div style="float: left"><button class="button success add-option'+START_NUMBER+'">Add Option</button><textarea id="question'+START_NUMBER+'text"></textarea></div><div class="options" style="float: left; margin-left:20px; margin-top: 30px;"></div></div>');
        tinymce.init({
            selector: '#question'+START_NUMBER+'text',
            width: 600,
            theme: 'modern',
            relative_urls: false,
            menubar: false,
            toolbar: [
                'undo redo | styleselect | bold italic | link jbimages',
                'alignleft aligncenter alignright'
            ],
            plugins : 'advlist autolink link image lists charmap print preview jbimages'
        });
        $('a[href=#question'+START_NUMBER+']').click()
        bindaddoption(START_NUMBER)
        var pagination = $('.pagination');
        var defaultPageOpts = {
            visiblePages: 7,
            paginationClass: 'pagination',
            pageClass: 'item',
            activeClass: 'current',
            first: '<<',
            last: '>>',
            nextClass: 'item',
            lastClass: 'item',
            firstClass: 'item',
            prevClass: 'item',
            onPageClick: function (event, page) {
                $('a[href=#question'+page+']').click();
                CURRENT_PAGE = page;
            }
        };
        var currentPage = START_NUMBER;
        var totalPages = $('.tabs').children().length;
        pagination.twbsPagination('destroy');
        pagination.twbsPagination($.extend({}, defaultPageOpts, {
            startPage: currentPage,
            totalPages: totalPages
        }));
        START_NUMBER++;
    }

    function bindeditoptionmodal()
    {
        $('.edit-option-modal').on('click', function(){
            TARGET = $(this)
            var inst = $('[data-remodal-id=edit-option-modal]').remodal();
            inst.open();
        })
    }   

    function deleteoption()
    {
        $('.delete-option').on('click', function(){
            $(this).parent().remove()
        })
    } 

    $('#edit-option').on('click', function(){
        TARGET.parent().children().eq(0).val($('#option-edit').val())
        TARGET.parent().children().eq(1).text($('#option-edit').val())
        var inst = $('[data-remodal-id=edit-option-modal]').remodal();
        inst.close();
    })

    $('#add-question').on('click', function(){
        addQuestion();
    })

    function bindaddoption(START_NUMBER)
    {
        $('.add-option'+START_NUMBER).on('click',
            function()
            {
                //console.log($(this).parent().parent())
                $(this).parent().parent().children().eq(1).append('<div class="option'+CURRENT_PAGE+'" style="margin-bottom: 10px"><input type="radio" value="" name="options'+CURRENT_PAGE+'">&nbsp;&nbsp;<label>OPTION</label>&nbsp;&nbsp;&nbsp;<i class="fa fa-pencil edit-option-modal" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-eraser delete-option" aria-hidden="true"></i></div>');
                //OPTIONS_BASE_NUMBER++;
                bindeditoptionmodal()
                deleteoption()
            })
    }

    function submitexam()
    {
        var current_url = window.location.href;
        var split_url = current_url.split("/");
        var exam_id = split_url[6].replace("#", "");
        var exam = new Array;
        var num_of_questions = $('.tabs').children().length;
        for(var i=0;i<num_of_questions;i++)
        {
            console.log(i+1);
            question = {};
            question.question_text = tinyMCE.get('question'+(i+1)+'text').getContent();
            options = new Array;
            options_target = $('#question'+(i+1)+' .options');
            options_length = options_target.children().length;
            for(var j=0;j<options_length;j++)
            {
                options.push(options_target.children().eq(j).children().eq(0).val())
                if(options_target.children().eq(j).children().eq(0).is(':checked')) { question.correct_option = options_target.children().eq(j).children().eq(0).val()}
            }
            question.options = JSON.stringify(options);
            exam.push(question)
        }
        //console.log(num_of_questions);
        console.log(JSON.stringify(exam));
        $.post('/index.php/cbt/submit',
        {
            exam_id: exam_id,
            exam: JSON.stringify(exam)
        }, 
        function(data){
            alert("Questions submitted")
        })
    }

</script>

<style type="text/css">
    .current a {
        color: #fff;
    }

    .tabs {
        display: none;
    }
</style>