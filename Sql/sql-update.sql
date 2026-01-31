UPDATE users 
SET role = 'student', approved_status = 'pending' 
WHERE role = 'instructor' AND approved_status = 'approved';
