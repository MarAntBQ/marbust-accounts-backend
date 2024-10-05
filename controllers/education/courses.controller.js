const config = require('../../config');
const sendEmail = require('../../services/sendEmail.service');

const MarbustEducationCourseCategory = require('../../models/education/MarbustEducationCourseCategory.model');
const MarbustEducationCourse = require('../../models/education/MarbustEducationCourse.model');

exports.createNew = async (req, res) => {
    try {
        const { name, publishedDate, categoryId, enabled } = req.body;

        // Validate Category
        const category = await MarbustEducationCourseCategory.findByPk(categoryId);
        if (!category) {
            return res.status(400).json({ error: 'Invalid category ID' });
        }

        // Predeterminated values
        const finalPublishedDate = publishedDate || new Date();
        const finalEnabled = enabled !== undefined ? enabled : true

        // Crear el nuevo curso
        const newCourse = await MarbustEducationCourse.create({
            name,
            publishedDate: finalPublishedDate,
            categoryId,
            enabled: finalEnabled
        });

        // Send email to admin about the new course
        // const emailSubject = `Creación de cuenta - Verificación OTP [${otpCode}]`;
        // const emailBody = `¡Bienvenido a <strong>${config.appName}</strong>! Tu cuenta ha sido creada exitosamente.
        // <br>
        // Por favor verifica tu dirección de correo electrónico ingresando el siguiente código OTP: <strong>${otpCode}</strong> en la página de verificación.
        // <br>
        // Link de verificación: <a href="${config.urls.frontend}/confirm-otp">Verificar OTP</a>
        // `;
        // await sendEmail(email, emailSubject, emailBody);
        const emailSubject = `Nuevo curso creado - ${name} | Marbust Education®`;
        const emailBody = `Un nuevo curso ha sido creado en Marbust Education®. Los detalles son:
        <br>
        <strong>Nombre:</strong> ${name}
        <br>
        <strong>Fecha de publicación:</strong> ${finalPublishedDate.toISOString().split('T')[0]}
        <br>
        <strong>Categoría:</strong> ${category.name}
        <br>
        <strong>Estado:</strong> ${finalEnabled ? 'Habilitado' : 'Deshabilitado'}
        <br>
        <br>
        ¡Gracias por usar Marbust Education®!`;
        await sendEmail('education@marbust.com', emailSubject, emailBody);

        res.status(201).json(newCourse);
    } catch (error) {
        console.error(error);
        res.status(500).json({ error: 'Internal server error', serverReport: error});
    }
};

exports.getAllCategories = async (req, res) => {
    try {
        const categories = await MarbustEducationCourseCategory.findAll({
            attributes: ['id', 'name']
        });
        res.status(200).json(categories);
    } catch (error) {
        console.error(error);
        res.status(500).json({ error: 'Internal server error', serverReport: error});
    }
};

exports.getCourseDetails = async (req, res) => {
    try {
        const { courseId } = req.params;
        const course = await MarbustEducationCourse.findByPk(courseId, {
            include: {
                model: MarbustEducationCourseCategory,
                attributes: ['name']
            }
        });

        if (!course) {
            return res.status(404).json({ error: `Course with id: ${courseId} not found`});
        }

        const response = {
            id: course.id,
            name: course.name,
            publishedDate: course.publishedDate,
            enabled: course.enabled,
            category: course.MarbustEducationCourseCategory.name,
            categoryId: course.categoryId
        };

        res.status(200).json(response);
    } catch (error) {
        console.error(error);
        res.status(500).json({ error: 'Internal server error', serverReport: error});
    }
};

exports.getAllCourses = async (req, res) => {
    try {
        const courses = await MarbustEducationCourse.findAll({
            include: {
                model: MarbustEducationCourseCategory,
                attributes: ['name']
            }
        });

        if (courses.length === 0) {
            return res.status(404).json({ error: 'No courses found' });
        }

        const response = courses.map(course => ({
            id: course.id,
            name: course.name,
            publishedDate: course.publishedDate.toISOString().split('T')[0],
            enabled: course.enabled,
            category: course.MarbustEducationCourseCategory.name,
            categoryId: course.categoryId
        }));

        res.status(200).json(response);
    } catch (error) {
        console.error(error);
        res.status(500).json({ error: 'Internal server error', serverReport: error });
    }
};