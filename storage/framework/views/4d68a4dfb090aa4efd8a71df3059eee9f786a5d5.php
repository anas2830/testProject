
<p>Total Questions = <?php echo e($finalResult->total_questions); ?></p>
<p>Given Questions = <?php echo e($finalResult->total_answer); ?></p>
<p>Correct Answer = <?php echo e($finalResult->total_correct_answer); ?></p>
<p>Per Question Mark = <?php echo e($finalResult->per_question_mark); ?></p>
<p>Get Mark = <?php echo e($finalResult->per_question_mark * $finalResult->total_correct_answer); ?>



<!-- Content area -->
<div class="content">
    <div class="panel panel-body">
        <?php $__currentLoopData = $examQuestions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $givenAnswer = (!empty($question->answer)) ? unserialize($question->answer) : [];
        ?>
    
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label><b style="font-size: 18px">Q<?php echo e(++$key); ?>) <?php echo $question->question; ?></b></label>
                    <?php if($question->answer_type == 1): ?> 
                    <?php
                        if($question->answered==0) { $givenAnswer[0]=2; /*Not_Answered*/ }
                    ?>
                        <div class="radio">
                            <label class="
                                <?php if($givenAnswer[0]==1): ?><?php if($question->answerSet[0]->true_answer==1): ?><?php echo e('text-success'); ?><?php else: ?><?php echo e('text-danger'); ?><?php endif; ?> <?php endif; ?>" for="ans-<?php echo e($question->question_id); ?>-01">
                                    <input name="answer_<?php echo e($question->question_id); ?>" id="ans-<?php echo e($question->question_id); ?>-01" type="radio" disabled <?php if($givenAnswer[0]==1): ?><?php echo e('checked='); ?><?php endif; ?>>
                                    <span class="<?php if($question->answerSet[0]->true_answer==1 && $givenAnswer[0]!=1): ?><?php echo e('text-danger'); ?><?php endif; ?>">True</span> 
                                    <?php if($question->answerSet[0]->true_answer==1): ?>| <span class="text-success"><i class="icon-checkmark4"></i> Correct</span>
                                <?php endif; ?>
                            </label>
                        </div>
                        <div class="radio">
                            <label class="
                                <?php if($givenAnswer[0]==0): ?><?php if($question->answerSet[0]->true_answer==0): ?><?php echo e('text-success'); ?><?php else: ?><?php echo e('text-danger'); ?><?php endif; ?> <?php endif; ?>" for="ans-<?php echo e($question->question_id); ?>-02"><input name="answer_<?php echo e($question->question_id); ?>" id="ans-<?php echo e($question->question_id); ?>-02" type="radio" disabled <?php if($givenAnswer[0]==0): ?><?php echo e('checked='); ?><?php endif; ?>>
                                <span class="<?php if($question->answerSet[0]->true_answer==0 && $givenAnswer[0]!=0): ?><?php echo e('text-danger'); ?><?php endif; ?>">False</span> <?php if($question->answerSet[0]->true_answer==0): ?>| 
                                <span class="text-success"><i class="icon-checkmark4"></i> Correct</span>
                                <?php endif; ?>
                            </label>
                        </div>
                    <?php else: ?> 
                    <?php
                        $labelClass = $question->answer_type == 2 ? 'radio' : 'checkbox';
                        $labelType = $question->answer_type == 2 ? 'radio' : 'checkbox';
                    ?>
                        <?php $__currentLoopData = $question->answerSet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="<?php echo e($labelClass); ?>">
                            <label class="<?php if(in_array($answer->id,$givenAnswer)): ?><?php if($answer->true_answer==1): ?><?php echo e('text-success'); ?><?php else: ?><?php echo e('text-danger'); ?><?php endif; ?> <?php endif; ?>" for="ans-<?php echo e($answer->id); ?>">
                                <input type="<?php echo e($labelType); ?>" name="answer_<?php echo e($question->question_id); ?>" id="ans-<?php echo e($answer->id); ?>" disabled <?php if(in_array($answer->id,$givenAnswer)): ?><?php echo e('checked='); ?><?php endif; ?> class="styled">
                                <span class="<?php if($answer->true_answer==1 && !in_array($answer->id,$givenAnswer)): ?><?php echo e('text-danger'); ?><?php endif; ?>"><?php echo $answer->answer; ?></span><?php if($answer->true_answer==1): ?> | 
                                <span class="text-success"><i class="icon-checkmark4"></i> Correct</span><?php endif; ?></label>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
                <legend class="text-bold"></legend>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<!-- /content area --><?php /**PATH D:\xampp\htdocs\laravel-blog-v1\resources\views/website/class/examResult.blade.php ENDPATH**/ ?>