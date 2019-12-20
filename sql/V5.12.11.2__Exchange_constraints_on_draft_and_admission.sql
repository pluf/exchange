
ALTER TABLE `exchange_admissions` 
   ADD CONSTRAINT `fk__day_of_admission` 
   FOREIGN KEY (`day_id`) 
   REFERENCES `exchange_days` (`id`);


ALTER TABLE `exchange_drafts` 
   ADD CONSTRAINT `fk__day_of_draft` 
   FOREIGN KEY (`day_id`) 
   REFERENCES `exchange_days` (`id`);

