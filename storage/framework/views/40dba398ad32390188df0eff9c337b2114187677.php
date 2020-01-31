<?php $__env->startSection('content'); ?>





<div class="card card-default">
    <div class="card-header">
        <?php echo e(isset($catagory)?'Edit Catagory' : 'Create catagory'); ?>

    </div>
    <div class="card-body">
        <?php if($errors->any()): ?>

        <div class="alert alert-danger">
            <ul class="list-group">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="list-group-item text-danger">
                        <?php echo e($error); ?>

                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>

        </div>
        <?php endif; ?>

        <form action="<?php echo e(isset($catagory) ? route('catagories.update',$catagory->id):route('catagories.store')); ?>" method = "POST">
        <?php echo csrf_field(); ?>

      

        <?php if(isset($catagory)): ?>
          <?php echo method_field('PUT'); ?>
            


        <?php endif; ?>

       
            <div class="form-group">
                <label for="name">Name</label>
            <input type="text" class="form-control" name="name" value="<?php echo e(isset($catagory)? $catagory->name : ''); ?>">

            </div>

            <div class="form-group">
                <button class="btn btn-success"> 
                    <?php echo e(isset($catagory) ? 'Update Catagory' :'Create Catagory'); ?>


                </button>
            </div>
        </form>
    </div>

</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\Laravel\cms2\resources\views/catagories/create.blade.php ENDPATH**/ ?>