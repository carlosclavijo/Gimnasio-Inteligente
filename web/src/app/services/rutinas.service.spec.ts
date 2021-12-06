import { TestBed } from '@angular/core/testing';

import { GetRutinasService } from './rutinas.service';

describe('GetRutinasService', () => {
  let service: GetRutinasService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(GetRutinasService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
