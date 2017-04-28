class Enrollment < ActiveRecord::Base
	belongs_to :user
	belongs_to :course

	validates :fecha_alta, presence: true
end
