class Course < ActiveRecord::Base
	belongs_to :events

	validates :nombre, :descripcion, :activo, :dia_hora, :duracion, presence: true, message: "no puede ser vacío"
	validates :duracion, numericality: true, message: "sólo puede contener números"

end
