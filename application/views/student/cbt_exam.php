<div class="m-content">
   
<h3><?php echo(strtoupper($exam_options[0]->subject)) ?></h3>
<?php $question = json_decode($questions[0]->question);
 ?>
<div class="panel">
<div class="heading">
        <span class="mif-event-available icon"></span>
        <span class="title">COMPUTER BASE TEST <B style="color:red;">ANSWER ALL QUESTIONS BEFORE YOU CLICK SUBMIT</B></span>
    </div>
	<div class="content">
<div class="grid">
    <div class="row cells12">
        <div class="cell offset6 colspan2">
            <div id="countdownExample">
                <h2 class="values"></h2>
            </div>
        </div>
        <div class="cell colspan4">
            <input class="button" type="submit" value="Submit Exam" id="submit-exam">
            <input class="button" type="hidden" value="Submit Exam" id="submit-exam2">
           
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
                    <?php $i = 1; foreach($question as $key=>$q) { ?>
                        <div class="frame" id="question<?php echo $i; ?>">
                            <div style="border: 1px solid #000; padding: 20px" id="question_text<?php echo($key+1) ?>">
                                <?php echo $q->question_text; ?>
                            </div>
                            <div class="options" style="float: left; margin-left:20px; margin-top: 30px;">
                                <?php $opt = json_decode($q->options); foreach($opt as $o) { ?>
                                    <div class="option<?php echo $i; ?>" style="margin-bottom: 10px">
                                        <input type="radio" value="<?php echo $o; ?>" name="options<?php echo $i; ?>" <?php if($q->correct_option==$o){echo "checked";} ?>>&nbsp;&nbsp;
                                        <label><?php echo $o; ?></label>&nbsp;&nbsp;&nbsp;</div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php $i++; } ?>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

<script>

    // bindeditoptionmodal();
    // deleteoption();
    
    
    
    $('#submit-exam').on('click', function(){
        
        if (confirm('ARE YOU SURE YOU WANT TO SUBMIT THIS EXAM?')) {         
    submitexam();        
  } else {
    return false;
  }
        
    })
    
    $('#submit-exam2').on('click', function(){
        submitexam();
    })
    
    $('.pagination').twbsPagination({
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

    BASE_NUMBER = 1;
    START_NUMBER = <?php echo count($question)+1; ?>;
    QUESTIONS_CONTAINER = $('#questions-container');
    QUESTIONS_INDICATOR = $('#questions-indicator');
    OPTIONS_BASE_NUMBER = 1;
    CURRENT_PAGE = 0;
    var num_of_questions = $('.tabs').children().length;
        for(var i=0;i<num_of_questions;i++)
        {
            options_target = $('#question'+(i+1)+' .options');
            options_length = options_target.children().length;
            for(var j=0;j<options_length;j++)
            {
                if(options_target.children().eq(j).children().eq(0).is(':checked')) {options_target.children().eq(j).children().eq(0).attr('checked', false)}
            }
            //question.options = JSON.stringify(options);
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
            question.question_text = $('#question_text'+(i+1)).children().eq(0).text().trim();
            options = new Array;
            options_target = $('#question'+(i+1)+' .options');
            options_length = options_target.children().length;
            for(var j=0;j<options_length;j++)
            {
                options.push(options_target.children().eq(j).children().eq(0).val())
                if(options_target.children().eq(j).children().eq(0).is(':checked')) { question.correct_option = options_target.children().eq(j).children().eq(0).val()}
            }
            //question.options = JSON.stringify(options);
            exam.push(question)
        }
        //console.log(num_of_questions);
        console.log(exam)
        //console.log(JSON.stringify(exam));
      
        $.post('/index.php/cbt/jamb_student_submit',
        {
            exam_id: exam_id,
            subject: '<?php echo(strtoupper($exam_options[0]->subject)) ?>',
            exam: JSON.stringify(exam)
        }, 
        function(data){
            alert("Exam submitted, YOUR SCORE IS  "+data)
            location.href = '/index.php/cbt/history';
        })
    }

    var timer = new Timer();
    timer.start({countdown: true, startValues: {minutes: <?php echo($exam_options[0]->time); ?>}});
    $('#countdownExample .values').html(timer.getTimeValues().toString());
    timer.addEventListener('secondsUpdated', function (e) {
        $('#countdownExample .values').html(timer.getTimeValues().toString());
    });
    timer.addEventListener('targetAchieved', function (e) {
        $('#submit-exam2').click();
    });
</script>

<style type="text/css">
    .current a {
        color: #fff;
    }

    .tabs {
        display: none;
    }
</style>