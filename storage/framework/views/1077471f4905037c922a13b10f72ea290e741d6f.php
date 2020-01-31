<?php $__env->startSection('content'); ?>

    <div class="card">
                <div class="card-header">My Profile</div>

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

                <form action="<?php echo e(route('users.update-profile')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id='name' value="<?php echo e($user->name); ?>">

                    </div>

                     <div class="form-group">
                        <label for="about">About Me</label>
                        <textarea name="about" id="about" cols="5" rows="5" class="form-control"><?php echo e($user->about); ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-success">Update Profile</button>


                </form>

                </div>
            </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\Laravel\cms2\resources\views/users/edit.blade.php ENDPATH**/ ?>