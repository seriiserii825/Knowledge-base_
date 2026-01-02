### file service

```ts
import { BadRequestException, Injectable } from "@nestjs/common";
import IFileResponse from "./interfaces/IFileResponse";
import { path } from "app-root-path";
import { ensureDir } from "fs-extra";
import { writeFile } from "fs/promises";

@Injectable()
export class FileService {
  async uploadFiles(files: Express.Multer.File[], folder: string = "products") {
    const uploadedFolder = `${path}/uploads/${folder}`;
    console.log("uploadedFolder", uploadedFolder);
    await ensureDir(uploadedFolder);

    const response: IFileResponse[] = await Promise.all(
      files.map(async (file) => {
        const originalName = `${Date.now()}-${file.originalname}`;
        console.log("originalName", originalName);
        try {
          await writeFile(`${uploadedFolder}/${originalName}`, file.buffer);
          return {
            url: `/uploads/${folder}/${originalName}`,
            name: originalName,
          };
        } catch (error) {
          console.log(error, "error");
          throw new BadRequestException(`File upload error`);
        }
      }),
    );
    return response;
  }
}
```

### controller

```ts
import {
  Controller,
  HttpCode,
  Post,
  Query,
  UploadedFiles,
  UseGuards,
  UseInterceptors,
} from "@nestjs/common";
import { FileService } from "./file.service";
import { Auth } from "src/auth/decorators/auth.decorator";
import { JwtAuthGuard } from "src/auth/guards/jwt-auth.guard";
import { FilesInterceptor } from "@nestjs/platform-express";

@Auth()
@UseGuards(JwtAuthGuard)
@UseInterceptors(FilesInterceptor("files"))
@Controller("files")
export class FileController {
  constructor(private readonly fileService: FileService) {}

  @HttpCode(200)
  @Post()
  uploadFiles(@UploadedFiles() files: Express.Multer.File[], @Query("folder") folder?: string) {
    // return 'File upload endpoint is under construction.';
    return this.fileService.uploadFiles(files, folder);
  }
}
```

### postman

- POST http://localhost:3000/files?folder=products
- Body → form-data
- Key: 'files' (type: File) → select multiple files
- Send
