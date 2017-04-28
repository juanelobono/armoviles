class User < ActiveRecord::Base
	has_many :enrollments, dependent: :destroy
	
	validates :nombre, :apellido, :email, :password, :fecha_nacimiento, :domicilio, 
						:telefono, :dni, :legajo, :activo, presence: true, message: "no puede ser vacío"
	validates :password, lenght: { minimum: 6, message: "muy corta (al menos 6 caracteres)" }
	validates :legajo, :dni, numericality: { only_integer: true, message: "sólo puede contener números" } 
	validates :legajo, uniqueness: true, message: "ya registrado"
end
