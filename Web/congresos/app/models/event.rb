class Event < ActiveRecord::Base
	has_many :courses, dependent: :destroy

	validates :fecha_inicio, :fecha_fin, :descripcion, :lugar, presence: true
end
